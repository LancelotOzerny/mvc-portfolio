const { parallel, series, watch, src, dest } = require("gulp");
const pug = require('gulp-pug')
const less = require('gulp-less')
const typescript = require('gulp-typescript')
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const imagemin = require('gulp-imagemin');
const replace = require('gulp-replace');


// ==========================================
// SECTION: Настройка проекта
// ==========================================
const config = {
    inputDir: './src',
    outputDir: './public_html',
}





// ==========================================
// SECTION: Настройка путей проекта
// ==========================================
let pathes = new class {
    pug = {
        follow: config.inputDir + '/**/*.pug',
        src: config.inputDir + '/pages/**/*.pug',
        dest: config.outputDir,
    };

    less = {
        follow: {
            base: config.inputDir + '/less/**/*.less',
            components: config.inputDir + '/components/**/*.less',
        },
        src: {
            base: config.inputDir + '/less/compile/**/*.less',
            components: config.inputDir + '/components/**/*.less',
        },
        dest: config.outputDir + '/assets/css/',
    };

    images = {
        src: config.inputDir + '/assets/**/*.{png,svg,jpg,jpeg}',
        dest: config.outputDir + '/assets/',
    };

    fonts = {
        src: config.inputDir + '/assets/fonts/**/*.ttf',
        dest: config.outputDir + '/assets/fonts/',
    };

    javascript = {
        src: config.inputDir + '/js/**/*.js',
        dest: config.outputDir + '/assets/scripts/',
    };

    typescript = {
        follow: config.inputDir + '/**/*.ts',
        src: config.inputDir + '/typescript/compile/**/*.ts',
        components_src: config.inputDir + '/components/**/*.ts',
        dest: config.outputDir + '/assets/scripts/',
    };
};









// ==========================================
// SECTION: Задачи проекта
// ==========================================
// ========================================== BrowserSync
const browserTasker = new class
{
    init()
    {
        browserSync.init({
            server: {
                baseDir: config.outputDir
            },
            files: [
                config.outputDir + '/**/*.html',
                config.outputDir + '/**/*.css',
                config.outputDir + '/**/*.js',
            ],
            notify: false,
            port: 3000,
            open: true,
        });
    }

    reloadPage(done)
    {
        browserSync.reload();
        done();
    }

    updatePage(done)
    {
        browserSync.reload({stream: true});
        done();
    }
}






// ========================================== PUG
const pugTasker = new class
{
    compile(done) {
        if (!pathExists(pathes.pug.src)) {
            console.log('Pug source directory not found:', pathes.pug.src);
            done();
            return;
        }

        console.log('Compiling Pug files...');

        return src(pathes.pug.src)
            .pipe(pug({ pretty: true }))
            .on('error', (err) => {
                console.error('Pug compilation failed:', err);
                done(err);
            })
            .pipe(dest(pathes.pug.dest))
            .on('end', () => {
                console.log('Pug compiled successfully.');
                done();
            });
    }


    watch()
    {
        let followPath = pathes.pug.follow ?? pathes.pug.src;
        watch(followPath, series(this.compile, browserTasker.reloadPage));
    }
}







// ========================================== LESS
const lessTasker = new class
{
    baseCompile(done)
    {
        if (pathExists(pathes.less.src.base) === false)
        {
            done();
            return;
        }

        return src(pathes.less.src.base)
            .pipe(less({}))
            .pipe(dest(pathes.less.dest))
    }

    componentsCompile(done)
    {
        if (pathExists(pathes.less.src.components) === false)
        {
            done();
            return;
        }

        return src(pathes.less.src.components)
            .pipe(less({}))
            .pipe(concat('components.css'))
            .pipe(dest(pathes.less.dest))
    }

    watch()
    {
        watch(pathes.less.follow.components, series(this.componentsCompile, browserTasker.updatePage));
        watch(pathes.less.follow.base, series(this.baseCompile, browserTasker.updatePage));
    }
}








// ========================================== TYPESCRIPT
const tsTasker = new class
{
    compile(done)
    {
        if (pathExists(pathes.typescript.src))
        {
            const tsProject = typescript.createProject('tsconfig.json');

            src(pathes.typescript.src)
                .pipe(tsProject())
                .js
                .pipe(replace(/@components\//g, './components/'))
                .pipe(dest(pathes.typescript.dest))
                .on('end', () => {
                    if (done)
                    {
                        done();
                    }
                });
        }
        else if (done)
        {
            done();
        }

        if (pathExists(pathes.typescript.components_src))
        {
            const tsProject = typescript.createProject('tsconfig.json');

            src(pathes.typescript.components_src)
                .pipe(tsProject())
                .js
                .pipe(replace(/@components\//g, './components/'))
                .pipe(dest(pathes.typescript.dest + 'components/'))
                .on('end', () => {
                    if (done)
                    {
                        done();
                    }
                });
        }
        else if (done)
        {
             done();
        }
    }

    watch() {
        let followPath = pathes.typescript.follow ?? pathes.typescript.src;
        watch(followPath, series(this.compile, browserTasker.reloadPage));

        // Дополнительно наблюдаем за компонентами
        watch(pathes.typescript.components_src, series(this.compile, browserTasker.reloadPage));
    }
};








// ========================================== JAVASCRIPT
const jsTasker = new class
{
    optimize(done)
    {
        if (pathExists(pathes.javascript.src) === false)
        {
            done();
            return;
        }

        return src(pathes.javascript.src)
            .pipe(dest(pathes.typescript.dest))
    }

    watch()
    {
        let followPath = pathes.javascript.follow ?? pathes.javascript.src;
        watch(followPath, series(this.optimize, browserTasker.reloadPage));
    }
}








// ========================================== IMAGES
const imagesTasker = new class
{
    optimize(done)
    {
        if (pathExists(pathes.images.src) === false)
        {
            done();
            return;
        }

        return src(pathes.images.src, { encoding: false })
            .pipe(imagemin([
                imagemin.gifsicle({interlaced: true}),
                imagemin.mozjpeg({quality: 75, progressive: true}),
                imagemin.optipng({optimizationLevel: 5}),
                imagemin.svgo()
            ]))
            .pipe(dest(pathes.images.dest))
    }

    watch()
    {
        let followPath = pathes.images.follow ?? pathes.images.src;
        watch(followPath, series(this.optimize, browserTasker.reloadPage));
    }
}








// ========================================== FONTS
const fontsTasker = new class
{
    optimize(done)
    {
        if (pathExists(pathes.fonts.src) === false)
        {
            done();
            return;
        }

        return src(pathes.fonts.src, { encoding: false })
            .pipe(dest(pathes.fonts.dest))
    }

    watch()
    {
        let followPath = pathes.fonts.follow ?? pathes.fonts.src;
        watch(followPath, series(this.optimize, browserTasker.reloadPage));
    }
}







// ==========================================
// SECTION: FUNCTIONS
// ==========================================

function pathExists(globPattern)
{
    const files = require('glob').sync(globPattern);
    return files.length > 0;
}








// ==========================================
// SECTION: EXPORTS
// ==========================================

// ========================================== COMPILE
exports.compilePug  = pugTasker.compile;
exports.compileTs   = tsTasker.compile;
exports.compileLess = series(
    lessTasker.componentsCompile,
    lessTasker.baseCompile
);

// ========================================== OPTIMIZE
exports.optimizeJs      = jsTasker.optimize;
exports.optimizeImages  = imagesTasker.optimize;
exports.optimizeFonts   = fontsTasker.optimize;


// ========================================== OTHER
exports.default = parallel(
    series(
        pugTasker.compile,
        lessTasker.componentsCompile,
        lessTasker.baseCompile,
        tsTasker.compile
    ),
    jsTasker.optimize,
    imagesTasker.optimize,
    fontsTasker.optimize,
);

exports.watch = series(
    exports.default,
    () => {
        browserTasker.init();
        pugTasker.watch();
        lessTasker.watch();
        tsTasker.watch();
        jsTasker.watch();
    }
);