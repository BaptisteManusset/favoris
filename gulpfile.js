// Requis
var gulp = require('gulp');

// Include plugins
var plugins = require('gulp-load-plugins')(); // tous les plugins de package.json
var browserSync = require('browser-sync').create();


// Variables de chemins
var source = './src'; // dossier de travail
var destination = './wordpress/wp-content/themes/favoooris'; // dossier à livrer

gulp.task('css', function () {
	gulp.src(source + "/**/*.scss")
		.pipe(plugins.sass().on('error', plugins.sass.logError))
		.pipe(plugins.csscomb())
		.pipe(plugins.autoprefixer())
		.pipe(plugins.size({showFiles: true}))
		.pipe(plugins.csso())
		.pipe(plugins.size({showFiles: true}))
		.pipe(gulp.dest(destination))
		.pipe(browserSync.reload({
			stream: true
		}))
		.pipe(plugins.notify({message: 'CSS task complete'}));
});

gulp.task('js', function () {
	return gulp.src([
		source + "/*.js",
		source + '/assets/js/*.js'
	])
		.pipe(plugins.order([
			'assets/js/*.js',
			"*.js"
		]))
		// .pipe(plugins.uglify())
		.on('error', swallowError)
		.pipe(plugins.concat('script.js', {newLine: ';'}))
		.pipe(gulp.dest(destination))
		.pipe(browserSync.reload({
			stream: true
		}))
});

gulp.task('html', function () {
	gulp.src([
		source + '/**/*.php',
		source + '/**/*.html'
	])
	// .pipe(plugins.htmlPartial({
	// 	basePath: source + '/assets/html/'
	// }))
	// .pipe(plugins.htmlBeautify())
		.pipe(gulp.dest(destination))
		.pipe(browserSync.reload({
			stream: true
		}))
});


gulp.task('move', function () {
	gulp.src([source + "/**/*.cur", source + "/assets/favicon/*"])
		.pipe(gulp.dest(destination))
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('favicon', function () {
	gulp.src([source + "/assets/favicon/*"])
		.pipe(gulp.dest(destination + "/assets/favicon/"))
});


gulp.task('watch', ["images", "browserSync", "css", "html", "js", "favicon"], function () {
	// gulp.watch([source + '/**/*.php',source + '/**/*.html'], ['reload']);
	gulp.watch([
		source + '/**/*.php',
		source + '/**/*.html'
	], ['html']);

	gulp.watch(source + '/**/*.scss', ['css']);
	// gulp.watch(source + '/*.js', ['js']);
	gulp.watch(source + '/**/*.js', ['js']);
	gulp.watch(([
		source + '/assets/img/*.png', source + '/assets/img/*.jpg',
		source + '/assets/img/*.svg']), ['images'
	]);
	plugins.notify({message: 'Watch task complete'});
});


gulp.task('browserSync-orig', function () {
	browserSync.init({
		server: {
			baseDir: destination
		}
	})
});
gulp.task('browserSync', function () {
	browserSync.init({
		proxy: "localhost/licence/dafawp/wordpress/"
	})
});

gulp.task('reload', function () {
	browserSync.reload({
		stream: true
	});
});

gulp.task('images', function () {
	gulp.src([source + '/assets/img/**/*.png', source + '/assets/img/**/*.jpg', source + '/assets/img/**/*.svg'])
		.pipe(plugins.cache(plugins.imagemin({optimizationLevel: 3, progressive: true, interlaced: true})))
		.pipe(gulp.dest(destination + '/assets/img/'));
});

function swallowError(error) {  //contient l'erreur
	console.log(error.toString());
}


var iconfont = require("gulp-iconfont");
var iconfontCss = require("gulp-iconfont-css");

gulp.task("glyphicons", function () {
	var iconname = "icons";
	gulp.src(source + "/assets/glyphicons/**/*")
		.pipe(
			iconfontCss({
				fontName: iconname, // nom de la fonte, doit être identique au nom du plugin iconfont
				fontPath: "assets/font/", // emplacement des fontes finales
				targetPath: "_iconsfont.scss", // emplacement du css finale
				path: "scss"
			})
		)
		.on('glyphs', function (glyphs, options) {
			// CSS templating, e.g.
			console.log(glyphs, options);
		})
		.pipe(
			iconfont({
				fontName: iconname // identique au nom de iconfontCss
			})
		)
		.pipe(gulp.dest("temp"));


});