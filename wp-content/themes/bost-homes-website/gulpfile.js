/*
    Gulp task runner v2.1.0
    -----------------------

    Required command-line parameters:
    --dev-hostname (e.g. "example.com")
    --dev-path (e.g. "/relative-path-to-server-directory/"); leading slash is required
    --dev-open ("open" or "external")

    Optional command-line parameters:
    --dist-css (e.g. "./dist")
    --dist-images (e.g. "./dist/images")
    --source-sprite (e.g. "./src/sprite")

    --sprite-resize: Enable sprite resize (@2x -> @1x)
    --livereload: Use gulp-livereload instead of browserSync
    --css-beautify
    --css-normal


    Example WP command:
    gulp --dist-css="./" --source-sprite="./images/sprite" --dist-images="./images"
    gulp build --dist-css="./" --source-sprite="./images/sprite" --dist-images="./images"
*/

'use strict';

// Config
var config = {
    paths: {
        source: {
            css     : './postcss',
            js      : './js',
            sprite  : './images/sprite'
        },
        temp : {
            css     : './.temp'
        },
        dist : {
            css:               './assets',
            js:                './js',
            images:            './images',
            cssBundleFilename: 'bundle.css'
        }
    },
    images: {
        enableSpriteResize: false
    },
    css: {
        enableSourcemap: false,
        useSimpleImport: true,
        useFontMagician: false
    },
    user: {}, // Will be populated from 'server/2c-gulp-config.json'
    isBuilding: false
};

// Utilities
var utils = (function() {

    /**
     * Gets env variable or returns false if there is no varible
     * @param  {string} variable Variable name
     * @return {string}          Variable value
     */
    var getEnvVar = function(variable) {
        if (variable in envVars) {
            return envVars[variable];
        }

        return false;
    };

    /**
     * Prepare message for browser notify.
     * @param  {string} message raw message
     * @return {string}         parsed message - new lines replaced by html elements.
     */
    var beautifyMessage = function(message) {
        return '<p style="text-align: left">' + message.replace(/\n/g, '<br>') + '</p>';
    };

    /**
     * Get selector token from filename
     * @param  {File} file
     * @return {RegExp}      Tolen RegExp
     */
    var getSelectorToken = function(file) {
        var prefixRegex = /^_module(?!(\.form-elements))|^_region/gi;
        var token       = null;

        file = path.basename(file);

        if (prefixRegex.test(file)) {
            token = file.replace(prefixRegex, '');
            token = path.basename(token, '.css');
        }

        if (token) {
            return new RegExp('^(\\[class\\^?\\*?=\\"|\\\')?\\.?' + escapeRegExp(token.replace(/^./, '')) + '|\\$');
        }

        return token;
    };

    /**
     * Gets relative path to folder
     * @param  {string} path       Full path
     * @param  {string} relativeTo Folder name
     * @return {string}            Path relative to the folder
     */
    var getRelativePath = function(path, relativeTo) {
        if (path.match(new RegExp(relativeTo, 'i'))) {
            return path.split(new RegExp(relativeTo, 'i')).pop().replace(/\//g, '\\');
        } else {
            return '';
        }
    };

    /**
     * Gets path before folder
     * @param  {string} path       Full path
     * @param  {string} folderName Folder name
     * @return {string}            Path before the folder + folder name
     */
    var getPathToFolder = function(path, folderName) {
        var match = path.match(new RegExp(folderName, 'i'));
        if (match) {
            return path.split(new RegExp(folderName, 'i')).shift() + match[0];
        } else {
            return '';
        }
    };

    /**
     * Escape RegExp helper
     * @param  {String} str Source string
     * @return {String}     Escaped string
     */
    var escapeRegExp = function(str) {
      return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    };

    /**
     * Add number padding
     * @param  {Integer} number       Number to modify
     * @param  {Integer} targetLength Digits count
     * @return {String}              Number with padding
     */
    var leftPad = function(number, targetLength) {
        var output = number + '';

        while (output.length < targetLength) {
            output = '0' + output;
        }

        return output;
    };

    /**
     * Dash string generator
     * @param  {Integer} count Dashes count
     * @return {String}       Dashes string
     */
    var generateDashes = function(count) {
        return (new Array((count - 0) + 1).join('-'));
    };

    return {
        getEnvVar           : getEnvVar,
        beautifyMessage     : beautifyMessage,
        getSelectorToken    : getSelectorToken,
        getRelativePath     : getRelativePath,
        getPathToFolder     : getPathToFolder,
        escapeRegExp        : escapeRegExp,
        leftPad             : leftPad,
        generateDashes      : generateDashes
    };
})();


// Global requires
var fs                  = require('fs');
var path                = require('path');

var _                   = require('lodash');
var gulp                = require('gulp');
var changed             = require('gulp-changed');
var watch               = require('gulp-watch');
var rename              = require('gulp-rename');
var rimraf              = require('gulp-rimraf');
var copy                = require('gulp-copy');
var foreach             = require('gulp-foreach');
var runSequence         = require('run-sequence');
var plumber             = require('gulp-plumber');
var yargs               = require('yargs');
var postcssAPI          = require('postcss');
var postcss             = require('gulp-postcss');

var envVars = yargs.argv;

var configFileExist = false;

var modules = {
    userConfig  : function() {
        // Require
        var fileExists = require('file-exists');

        var configFilePath = utils.getPathToFolder(process.env.INIT_CWD, 'server')  + '/2c-gulp-config.json';

        var init = function() {
            configFileExist = fileExists(configFilePath);

            if (configFileExist) {
                config.user = require(configFilePath);

                if('modules' in config.user) {
                    for (var moduleName in config.user.modules) {

                        for (var configKey in config.user.modules[moduleName]) {
                            config[moduleName][configKey] = config.user.modules[moduleName][configKey];
                        };
                    };
                };
            };

            // Set configuration from env vars
            if(utils.getEnvVar('sprite-resize')) {
                config.images.enableSpriteResize = true;
            };

            if(utils.getEnvVar('dist-css')) {
                config.paths.dist.css = utils.getEnvVar('dist-css');
            };

            if(utils.getEnvVar('source-sprite')) {
                config.paths.source.sprite = utils.getEnvVar('source-sprite');
            };

            if(utils.getEnvVar('dist-images')) {
                config.paths.dist.images = utils.getEnvVar('dist-images');
            };

            if(utils.getEnvVar('dev-hostname')) {
                config.user.hostname = utils.getEnvVar('dev-hostname');
            };

            if(utils.getEnvVar('dev-path') && config.user.hostname) {
                config.user.path = config.user.hostname + utils.getEnvVar('dev-path');
            };

            if(utils.getEnvVar('dev-open')) {
                config.user.open = utils.getEnvVar('dev-open');
            };
        };

        return {
            init: init
        };
    }(),
    css         : function() {
        var postcssImport       = require('postcss-import');
        var postcssSimpleVars   = require('postcss-simple-vars');
        var postcssCalc         = require('postcss-calc');
        var postcssFontMagician = require('postcss-font-magician');
        var postcssColor        = require('postcss-color-function');
        var postcssMixins       = require('postcss-mixins');
        var postcssExtend       = require('postcss-simple-extend');
        var postcssBadSelectors = require('postcss-bad-selectors');
        var postcssReporter     = require('postcss-reporter');
        var sourcemaps          = require('gulp-sourcemaps');
        var autoprefixer        = require('autoprefixer');
        var filter              = require('gulp-filter');
        var i2r                 = require('gulp-image-to-rule');
        var cssbeautify         = require('gulp-cssbeautify');
        var cssmin              = require('gulp-cssmin');
        var gulpif              = require('gulp-if');
        var duration            = require('gulp-duration');
        var pipeErrorStop       = require('pipe-error-stop');

        var taskLazyRules = function() {

            return gulp.src(config.paths.source.sprite + '/*.png')
                .pipe(changed(config.paths.source.sprite + '/*.png'))
                .pipe(i2r(path.resolve(config.paths.source.css + '/_sprite.css'), {
                    selectorWithPseudo: '.{base}-{pseudo}, a:{pseudo} .{base}, button:{pseudo} .{base}, a.{pseudo} .{base}, button.{pseudo} .{base}, .{base}.{pseudo}'
                }))
                .pipe(gulp.dest('.'));
        };

        // CSS Post Processing
        var taskCompile = function() {
            // PostCSS processors
            var postcssProcessors = [];

            // CSS Import
            if ( config.css.useSimpleImport && !config.isBuilding ) {
                postcssProcessors.push(simpleImport);
            } else {
                postcssProcessors.push(postcssImport);
            };

            // Mixins
            postcssProcessors.push(postcssMixins);

            // Extend
            postcssProcessors.push(postcssExtend);

            // Variables
            postcssProcessors.push(postcssSimpleVars);

            // Reduces calcs, where possible
            postcssProcessors.push(postcssCalc({
                mediaQueries: true
            }));

            // Color functions
            postcssProcessors.push(postcssColor());

            // Font Magicician
            if ( config.css.useFontMagician ) {
                postcssProcessors.push(postcssFontMagician({
                    hosted: './css/fonts',
                    formats: 'woff2 woff ttf eot svg otf'
                }))
            }

            // Autoprefixer
            postcssProcessors.push(autoprefixer({ browsers: ['last 3 version'] }));

            // Table of contents
            postcssProcessors.push(modules.toc);

            // PostCSS task error handler
            var errorHandler = plumber(function(errorObj) {

                notify(errorObj);

                // End this task
                this.emit('end');
            });

            var notify = function(errorObj) {
                // Notify the user
                modules.livereload.notify('Error: ' + utils.beautifyMessage(errorObj.message));

                // Post the message in the console
                console.log(errorObj.message);
            };

            var css_type = cssmin;
            var css_plugin = true;

            if (utils.getEnvVar('css-beautify')) {

                css_type = cssbeautify;

            } else if (utils.getEnvVar('css-normal')) {

                css_plugin = false;
            }

            var task = gulp.src([config.paths.source.css + '/_module*.css', config.paths.source.css + '/_load.css'])
                .pipe(filter('_load.css'))                                        // filter only the load file
                .pipe(errorHandler)                                               // Prevent pipe breaking caused by errors
                .pipe(gulpif(config.css.enableSourcemap, sourcemaps.init()))      // source map init
                .pipe(postcss(postcssProcessors))                                 // post css
                .pipe(rename(config.paths.dist.cssBundleFilename))                // rename
                .pipe(gulpif(config.css.enableSourcemap, sourcemaps.write('.')))  // sourcemap write
                .pipe(gulpif(css_plugin, css_type()))                             // beautify CSS or minify
                .pipe(gulp.dest(config.paths.dist.css))                           // save css file
                .pipe(filter(config.paths.dist.cssBundleFilename))                // filter only css files (remove the map file)
                .pipe(modules.livereload.silentReload());                         // inject the changed css

            return task;
        };

        var taskImportModules = function() {
            // order
            var orderSymbols = ['I.   ', 'II.  ', 'III. ', 'IV.  ', 'V.   '];
            var fileTypeOrder = ['noGroup', 'generic', 'region', 'module', 'theme'];
            var fileTypeNames = {
                'generic': 'Generic',
                'region': 'Regions',
                'module': 'Modules',
                'theme': 'Themes'
            }
            var files = {};

            var task = gulp.src([config.paths.source.css + '/_*.css', '!' + config.paths.source.css + '/_load.css'])
                .pipe(foreach(function(stream, file){
                    var fileName = path.basename(file.path);
                    var fileType = fileName.match(/^_(.+?)\./)[1];
                    var isNoGroup = fileType && fileTypeOrder.indexOf(fileType) >= 0;

                    if(isNoGroup) {
                        if(!(fileType in files)) {
                            files[fileType] = [];
                        };

                        files[fileType].push(fileName);
                    } else {
                        if(!('noGroup' in files)) {
                            files.noGroup = [];
                        };

                        files.noGroup.push(fileName);
                    };

                    return stream;
                }));

            task.on('end', function() {

                var groups = [];

                for (var i = 0; i < fileTypeOrder.length; i++) {
                    var header = ''
                    var filesGroup = [];

                    if(fileTypeOrder[i] !== 'noGroup') {
                        header =    '/* ------------------------------------------------------------ *\\\n' +
                                        '\t' + orderSymbols.splice(0, 1) + fileTypeNames[fileTypeOrder[i]] + '\n' +
                                    '\\* ------------------------------------------------------------ */\n\n';
                    };

                    if(files[fileTypeOrder[i]]) {
                        if(fileTypeOrder[i] === 'generic') {
                            files[fileTypeOrder[i]].sort(function(a, b) {
                                if(a === '_generic.reset.css') {
                                    return -1;
                                };

                                if(b === '_generic.reset.css') {
                                    return 1;
                                };

                                return a - b;
                            });
                        };

                        for (var j = 0; j < files[fileTypeOrder[i]].length; j++) {
                            filesGroup.push('@import \'' + files[fileTypeOrder[i]][j] + '\';');
                        };

                        groups.push(header + filesGroup.join('\n\n'));
                    };
                };

                // Write to the file
                fs.writeFileSync(config.paths.source.css + '/_load.css', groups.join('\n\n') + '\n');
            });

            return task;
        };

        var init = function() {
            // Sprite images watch
            watch([config.paths.source.sprite + '/*.png', '!' + config.paths.source.sprite + '/*@2x.png', '!' + config.paths.source.sprite + '/*@3x.png'], {
                awaitWriteFinish: true
            }, function() {

                gulp.start(['css:lazy-rules']);
            });

            // CSS watch - run only on files that match this model: _*.css
            watch([config.paths.source.css + '/_*.css'], function() {
                gulp.start(['css:compile']);
            });

            // Module watch - run only on files that match this model: _*.css
            watch([config.paths.source.css + '/_*.css', '!' + config.paths.source.css + '/_load.css'], {
                events: ['add', 'unlink']
            }, function() {
                gulp.start(['css:import-modules']);
            });
        };

        var register = function() {
            gulp.task('css:lazy-rules', taskLazyRules);
            gulp.task('css:import-modules', taskImportModules);
            gulp.task('css:compile', taskCompile);
        };

        return {
            init: init,
            register: register
        };
    }(),
    javascript  : function() {
        var init = function() {
            // JS watch
            watch(config.paths.source.js + '/*.js', function() {
                modules.livereload.reload();
            });
        };

        return {
            init: init
        };
    }(),
    images      : function() {
        var gm                  = require('gulp-gm');
        var imagemin            = require('gulp-imagemin');
        var imageminJpegoptim   = require('imagemin-jpegoptim');
        var postcssSprites      = require('postcss-sprites');

        var taskSprites = function() {

            // CSS Post CSS Sprites prepare
            var spriteOpts    = {
                stylesheetPath: config.paths.source.css,
                spritePath    : config.paths.dist.images + '/sprite.png',
                retina        : true,
                filterBy      : function(image) {
                    return /sprite\//gi.test(image.url);
                },

                // Spritesmith options:
                padding       : 4
            };

            return gulp.src(config.paths.dist.css + '/' + config.paths.dist.cssBundleFilename)
                .pipe(postcss( [postcssSprites(spriteOpts)] ))
                .pipe(gulp.dest( config.paths.dist.css ));
        };

        var taskOptimiseImages = function() {
            return gulp.src([config.paths.build.images + '/**'])
                .pipe(imagemin({
                    progressive: true,
                    optimizationLevel: 3,
                    use: [
                        imageminJpegoptim({
                            max: 75
                        })
                    ]

                }))
                .pipe(gulp.dest(config.paths.build.images));
        };

        var taskResizeSprite3x = function() {
            return gulp.src(config.paths.source.sprite + '/*@3x.png')
                .pipe(changed(config.paths.source.sprite + '/*@3x.png'))
                .pipe(gm(function(gmfile) {
                    return gmfile.resize('66.66666666666666667%', '66.66666666666666667%');
                }))
                .pipe(rename(function(filepath) {
                    filepath.basename = filepath.basename.replace('@3x', '@2x');
                }))
                .pipe(gulp.dest(config.paths.source.sprite));
        };

        var taskResizeSprite2x = function() {
            return gulp.src(config.paths.source.sprite + '/*@2x.png')
                .pipe(changed(config.paths.source.sprite + '/*@2x.png'))
                .pipe(gm(function(gmfile) {
                    gmfile.size(function(err, value) {
                        if(value && (value.width % 2 !== 0 || value.height % 2 !== 0)) {
                            var src = gmfile.name().source;
                            modules.livereload.notify('Retina images must have even size!<br>' + src);

                            throw Error('Retina images must have even size! ' + src);
                        }
                    })
                    return gmfile.resize('50%', '50%');
                }))
                .pipe(rename(function(filepath) {
                    filepath.basename = filepath.basename.replace(/@\dx/, '');
                }))
                .pipe(gulp.dest(config.paths.source.sprite));
        };

        var taskResizeSpriteSource = function() {
            gulp.start(['images:resize-sprite-2x']);
        };

        var init = function() {
            if(config.images.enableSpriteResize) {
                // Resize images watch
                watch(config.paths.source.sprite + '/*@2x.png', {
                    awaitWriteFinish: true
                }, function() {

                    gulp.start(['images:resize-sprite-2x']);
                });

                // Resize images watch
                watch(config.paths.source.sprite + '/*@3x.png', {
                    awaitWriteFinish: true
                }, function() {
                    gulp.start(['images:resize-sprite-3x']);
                });
            }
        };

        var register = function() {
            gulp.task('images:sprites', taskSprites);

            gulp.task('images:optimize', taskOptimiseImages);

            gulp.task('images:resize-sprite-3x', taskResizeSprite3x);

            gulp.task('images:resize-sprite-2x', taskResizeSprite2x);

            if(config.images.enableSpriteResize) {
                gulp.task('images:resize-sprite-source', ['images:resize-sprite-3x'], taskResizeSpriteSource);
            } else {
                gulp.task('images:resize-sprite-source', []);
            };
        }

        return {
            init: init,
            register : register
        };
    }(),
    html        : function() {

        var init = function() {
            watch(['./*.*html', './ssi/*.*html', './templates/*.php', './fragments/*.php', './*.php'], function() {
                modules.livereload.reload();
            });
        };

        return {
            init: init
        }
    }(),
    build       : function() {

        var register = function() {

        }

        return {
            register: register
        };
    }(),
    livereload  : function() {

        var task = null;
        var reload = function() {};
        var notify = function() {};
        var silentReload = function() {};

        if(utils.getEnvVar('livereload')) {
            var livereload = require('gulp-livereload');

            task = function() {
                livereload({start: true});
            };

            reload = function () {
                livereload.reload();
            };

            silentReload = livereload;
        } else {
            var browserSyncModule   = require('browser-sync');
            var browserSync         = browserSyncModule.create();
            reload                  = browserSync.reload;


            // Browser sync server
            task = function() {
                browserSync.init({
                    proxy : config.user.path || ((config.user.hostname || 'localhost') + utils.getRelativePath(process.env.INIT_CWD, 'server')),
                    port  : 3000,
                    open  : ('open' in config.user ? config.user.open : 'external'),
                    host  : config.user.hostname || 'localhost',
                    notify: {
                        styles: [
                            'display: none;',
                            'padding: 7px 15px;',
                            'border-radius: 0 0 3px 3px;',
                            'position: fixed;',
                            'font-family: Arial, sans-serif',
                            'font-size: 14px;',
                            'font-weight: normal;',
                            'z-index: 9999;',
                            'right: 0px;',
                            'top: 24px;',
                            'background-color: rgba(30, 30, 30, .7);',
                            'color: #fff',
                            'pointer-events: none;'
                        ]
                    },
                    ghostMode: {
                        clicks: false,
                        scroll: true,
                        forms: {
                            submit: true,
                            inputs: true,
                            toggles: true
                        }
                    },
                    snippetOptions: {
                        // Provide a custom Regex for inserting the snippet.
                        rule: {
                            match: /<\/body>/i,
                            fn: function (snippet, match) {
                                // return snippet + match + '<script type="text/javascript" src="//stargate.2c-studio.com/pixelParallel/pixelParallel.build.js"></script>';

                                if (configFileExist) {
                                    return snippet + match
                                        + '<script src="//cdn.jsdelivr.net/pouchdb/5.2.1/pouchdb.min.js"></script>'
                                        + '<script type="text/javascript" src="//stargate.2c-studio.com/pixelParallel/v2/pixelParallel.build.js"></script>';
                                } else {
                                    return snippet + match;
                                }
                            }
                        }
                    }
                }, function(err, bs) {
                    function getFromCollectionById(collection, id) {
                        for (var i = 0; i < collection.length; i++) {
                            if(collection[i].id === id) {
                                return collection[i];
                            };
                        };

                        return null;
                    };

                });
            };

            silentReload = function() {
                return reload({stream: true});
            };

            notify = function(message, time) {
                browserSync.notify(message, time);
            };
        }

        var register = function() {
            gulp.task('livereload', task);
        };


        return {
            reload: reload,
            notify: notify,
            register: register,
            silentReload: silentReload
        };
    }(),
    /**
     * Table of contents generator
     * @param  {Object} style PostCSS style object
     */
    toc: function(style) {
        var tableLength = 50;
        var comments = [];
        var table = [];
        var majorCommentIdx = 0;
        var header = '\tTable of Contents'
        // + '\n\tupdate on ' + new Date().toString()
        ;

        style.walkComments(function(comment) {
            var majorCommentRegExp = /-*\s\*\\[\n\r]\s*(.*?)[\n\r]+\\\*\s-*/;
            var commentRaw = comment.source.input.css;

            if (comment.text.match(majorCommentRegExp)) {
                var commentText = comment.text.match(majorCommentRegExp)[1];
                comments.push({
                    text: commentText,
                    type: 'major',
                    isRoman: commentText.match(/^[\I\V\X]*\.\s/)
                });
            } else {
                if(/^[A-Z]/.test(comment.text)) {
                    comments.push({
                        text: comment.text,
                        type: 'minor'
                    });
                }
            }
        });

        for (var i = 0; i < comments.length; i++) {
            var commentPrefix = '';
            var tableText = '';

            if(comments[i].type === 'major') {
                if(!comments[i].isRoman) {
                    majorCommentIdx += 1;

                    commentPrefix = '     ' + utils.leftPad(majorCommentIdx, 2) + '. ';
                } else {
                    majorCommentIdx = 0;
                };
            } else {
                commentPrefix = '         ';
            };

            tableText = commentPrefix + comments[i].text;

            table.push(tableText + ' ' + utils.generateDashes(tableLength - tableText.length));
        };

        style.prepend({
            text: '\n' + header + '\n\n\t' + table.join('\n\t') + '\n'
        });


        if (style.first && style.first.next()) {
            style.first.next().raws.before = '\n\n';
        };
    }
};

var simpleImport = postcssAPI.plugin('postcss-simple-import', function (opts) {
    opts = opts || {};
    return function (css, result) {
        var newCSS = [];

        css.walkAtRules('import', function checkAtRule(atrule) {
            var file = atrule.params.replace(/\'/g, '');

            newCSS.push(fs.readFileSync(config.paths.source.css + '/' + file).toString());
        });

        result.root = postcssAPI.parse(newCSS.join('\n'));
    };
});

modules.userConfig.init();

modules.css.register();

modules.images.register();

modules.build.register();

modules.livereload.register();


// Serve Task
gulp.task('serve', ['livereload', 'images:resize-sprite-source', 'css:import-modules', 'css:compile'], function() {
    // Run after resize sprite source
    gulp.start('css:lazy-rules');

    modules.css.init();

    modules.javascript.init();

    modules.images.init();

    modules.html.init();
});

// Build Task
gulp.task('build', function() {
    config.isBuilding = true;

    runSequence('images:resize-sprite-source', 'css:lazy-rules', 'css:import-modules', 'css:compile', 'images:sprites');
});

// Defaut Task
gulp.task('default', ['serve']);
