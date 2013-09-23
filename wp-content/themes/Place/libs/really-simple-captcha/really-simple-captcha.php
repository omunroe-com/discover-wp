<?php
/*
Plugin Name: Really Simple CAPTCHA
Plugin URI: http://contactform7.com/captcha/
Description: Really Simple CAPTCHA is a CAPTCHA module intended to be called from other plugins. It is originally created for my Contact Form 7 plugin.
Author: Takayuki Miyoshi
Version: 1.6
Author URI: http://ideasilo.wordpress.com/
*/

/*  Copyright 2007-2013 Takayuki Miyoshi (email: takayukister at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define( 'REALLYSIMPLECAPTCHA_VERSION', '1.6' );

class ReallySimpleCaptcha {

	function ReallySimpleCaptcha() {

		/* Characters available in images */
		$this->chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

		/* Length of a word in an image */
		$this->char_length = 4;

		/* Array of fonts. Randomly picked up per character */
		$this->fonts = array(
			dirname( __FILE__ ) . '/gentium/GenBkBasR.ttf',
			dirname( __FILE__ ) . '/gentium/GenBkBasI.ttf',
			dirname( __FILE__ ) . '/gentium/GenBkBasBI.ttf',
			dirname( __FILE__ ) . '/gentium/GenBkBasB.ttf' );

		/* Directory temporary keeping CAPTCHA images and corresponding text files */
		$this->tmp_dir = path_join( dirname( __FILE__ ), 'tmp' );

		/* Array of CAPTCHA image size. Width and height */
		$this->img_size = array( 72, 24 );

		/* Background color of CAPTCHA image. RGB color 0-255 */
		$this->bg = array( 255, 255, 255 );

		/* Foreground (character) color of CAPTCHA image. RGB color 0-255 */
		$this->fg = array( 0, 0, 0 );

		/* Coordinates for a text in an image. I don't know the meaning. Just adjust. */
		$this->base = array( 6, 18 );

		/* Font size */
		$this->font_size = 14;

		/* Width of a character */
		$this->font_char_width = 15;

		/* Image type. 'png', 'gif' or 'jpeg' */
		$this->img_type = 'png';

		/* Mode of temporary image files */
		$this->file_mode = 0444;

		/* Mode of temporary answer text files */
		$this->answer_file_mode = 0440;
	}

	/**
	 * Generate and return a random word.
	 *
	 * @return string Random word with $chars characters x $char_length length
	 */
	function generate_random_word() {
		$word = '';

		for ( $i = 0; $i < $this->char_length; $i++ ) {
			$pos = mt_rand( 0, strlen( $this->chars ) - 1 );
			$char = $this->chars[$pos];
			$word .= $char;
		}

		return $word;
	}

	/**
	 * Generate CAPTCHA image and corresponding answer file.
	 *
	 * @param string $prefix File prefix used for both files
	 * @param string $word Random word generated by generate_random_word()
	 * @return string|bool The file name of the CAPTCHA image. Return false if temp directory is not available.
	 */
	function generate_image( $prefix, $word ) {
		if ( ! $this->make_tmp_dir() )
			return false;

		$this->cleanup();

		$dir = trailingslashit( $this->tmp_dir );
		$filename = null;

		if ( $im = imagecreatetruecolor( $this->img_size[0], $this->img_size[1] ) ) {
			$bg = imagecolorallocate( $im, $this->bg[0], $this->bg[1], $this->bg[2] );
			$fg = imagecolorallocate( $im, $this->fg[0], $this->fg[1], $this->fg[2] );

			imagefill( $im, 0, 0, $bg );

			$x = $this->base[0] + mt_rand( -2, 2 );

			for ( $i = 0; $i < strlen( $word ); $i++ ) {
				$font = $this->fonts[array_rand( $this->fonts )];

				// sanitize for Win32 installs
				$font = str_replace( '\\', '/', $font );
				$font = preg_replace( '|/+|', '/', $font );

				imagettftext( $im, $this->font_size, mt_rand( -12, 12 ), $x, $this->base[1] + mt_rand( -2, 2 ), $fg, $font, $word[$i] );
				$x += $this->font_char_width;
			}

			switch ( $this->img_type ) {
				case 'jpeg':
					$filename = sanitize_file_name( $prefix . '.jpeg' );
					imagejpeg( $im, $dir . $filename );
					break;
				case 'gif':
					$filename = sanitize_file_name( $prefix . '.gif' );
					imagegif( $im, $dir . $filename );
					break;
				case 'png':
				default:
					$filename = sanitize_file_name( $prefix . '.png' );
					imagepng( $im, $dir . $filename );
			}

			imagedestroy( $im );
			@chmod( $dir . $filename, $this->file_mode );
		}

		$this->generate_answer_file( $prefix, $word );

		return $filename;
	}

	/**
	 * Generate answer file corresponding to CAPTCHA image.
	 *
	 * @param string $prefix File prefix used for answer file
	 * @param string $word Random word generated by generate_random_word()
	 */
	function generate_answer_file( $prefix, $word ) {
		$dir = trailingslashit( $this->tmp_dir );
		$answer_file = $dir . sanitize_file_name( $prefix . '.txt' );

		if ( $fh = @fopen( $answer_file, 'w' ) ) {
			$word = strtoupper( $word );
			$salt = wp_generate_password( 64 );
			$hash = hash_hmac( 'md5', $word, $salt );

			$code = $salt . '|' . $hash;

			fwrite( $fh, $code );
			fclose( $fh );
		}

		@chmod( $answer_file, $this->answer_file_mode );
	}

	/**
	 * Check a response against the code kept in the temporary file.
	 *
	 * @param string $prefix File prefix used for both files
	 * @param string $response CAPTCHA response
	 * @return bool Return true if the two match, otherwise return false.
	 */
	function check( $prefix, $response ) {
		$response = strtoupper( $response );

		$dir = trailingslashit( $this->tmp_dir );
		$filename = sanitize_file_name( $prefix . '.txt' );
		$file = $dir . $filename;

		if ( @is_readable( $file ) && ( $code = file_get_contents( $file ) ) ) {
			$code = explode( '|', $code, 2 );

			$salt = $code[0];
			$hash = $code[1];

			if ( hash_hmac( 'md5', $response, $salt ) == $hash )
				return true;
		}

		return false;
	}

	/**
	 * Remove temporary files with given prefix.
	 *
	 * @param string $prefix File prefix
	 */
	function remove( $prefix ) {
		$suffixes = array( '.jpeg', '.gif', '.png', '.php', '.txt' );

		foreach ( $suffixes as $suffix ) {
			$filename = sanitize_file_name( $prefix . $suffix );
			$file = trailingslashit( $this->tmp_dir ) . $filename;
			if ( @is_file( $file ) )
				unlink( $file );
		}
	}

	/**
	 * Clean up dead files older than given length of time.
	 *
	 * @param int $minutes Consider older files than this time as dead files
	 * @return int|bool The number of removed files. Return false if error occurred.
	 */
	function cleanup( $minutes = 60 ) {
		$dir = trailingslashit( $this->tmp_dir );

		if ( ! @is_dir( $dir ) || ! @is_readable( $dir ) )
			return false;

		$is_win = ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) );

		if ( ! ( $is_win ? win_is_writable( $dir ) : @is_writable( $dir ) ) )
			return false;

		$count = 0;

		if ( $handle = @opendir( $dir ) ) {
			while ( false !== ( $filename = readdir( $handle ) ) ) {
				if ( ! preg_match( '/^[0-9]+\.(php|txt|png|gif|jpeg)$/', $filename ) )
					continue;

				$file = $dir . $filename;

				$stat = @stat( $file );
				if ( ( $stat['mtime'] + $minutes * 60 ) < time() ) {
					@unlink( $file );
					$count += 1;
				}
			}

			closedir( $handle );
		}

		return $count;
	}

	/**
	 * Make a temporary directory and generate .htaccess file in it.
	 *
	 * @return bool True on successful create, false on failure.
	 */
	function make_tmp_dir() {
		$dir = trailingslashit( $this->tmp_dir );

		if ( ! wp_mkdir_p( $dir ) )
			return false;

		$htaccess_file = $dir . '.htaccess';

		if ( file_exists( $htaccess_file ) )
			return true;

		if ( $handle = @fopen( $htaccess_file, 'w' ) ) {
			fwrite( $handle, 'Order deny,allow' . "\n" );
			fwrite( $handle, 'Deny from all' . "\n" );
			fwrite( $handle, '<Files ~ "^[0-9A-Za-z]+\\.(jpeg|gif|png)$">' . "\n" );
			fwrite( $handle, '    Allow from all' . "\n" );
			fwrite( $handle, '</Files>' . "\n" );
			fclose( $handle );
		}

		return true;
	}
}

?>