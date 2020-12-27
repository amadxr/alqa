const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	.js('resources/js/app.js', 'public/js')
	.postCss('resources/css/tw.css', 'public/css', [
		require('postcss-import'),
		require('tailwindcss'),
		require('postcss-nested'),
	])
	.sass('resources/sass/app.scss', 'public/css')
	.browserSync({
		open: 'external',
		host: 'alqa.test',
		proxy: 'alqa.test',
		files: [
			'resources/views/**/*.php',
			'app/**/*.php',
			'routes/**/*.php',
			'public/js/*.js',
			'public/css/*.css',
		],
	});

mix.copyDirectory('resources/assets/fonts', 'public/fonts');
