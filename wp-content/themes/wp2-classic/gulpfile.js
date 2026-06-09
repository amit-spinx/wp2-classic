const project = require("./project.json");
const { src, dest, series, parallel, watch } = require("gulp");
const cached = require("gulp-cached");
const gulpLoadPlugins = require("gulp-load-plugins");
const sass = require("gulp-sass")(require("sass"));
const cleanCSS = require("gulp-clean-css");
const terser = require("gulp-terser");
const plumber = require("gulp-plumber");
const concat = require("gulp-concat");
const sourcemaps = require("gulp-sourcemaps");
const yargs = require("yargs");
const merge = require("merge-stream");
const eslint = require('gulp-eslint');
var clean = require('gulp-clean');


const { argv } = yargs;
const isProduction = argv.production;

const $ = gulpLoadPlugins();
// SCSS
function minifySass() {
  // let stream = src("./assets/sass/pages/*.scss").pipe(plumber()).pipe(cached('sass'));
  let stream = src("./assets/sass/pages/*.scss").pipe($.plumber());
  if (isProduction) {
    stream = stream
      .pipe(sass().on("error", sass.logError))
      .pipe(cleanCSS())
      .pipe(cached("sass"))
      .pipe(dest("assets/css"));
  } else {
    stream = stream
      .pipe(sourcemaps.init({ loadMaps: true }))
      // .pipe(sass.sync({ outputStyle: "compressed" }).on("error", sass.logError))
      .pipe(sass.sync().on("error", sass.logError))
      .pipe(cached("sass"))
      .pipe(cleanCSS())
      .pipe(sourcemaps.write("."))
      .pipe(dest("assets/css"));
  }
  return stream;
}

// JS: Global js merged
function globalJs() {
  return src(project.vendor.js.concat(project.app.js))
    .pipe(plumber())
    .pipe(concat("app.js"))
    .pipe(cached("js"))
    .pipe(terser())
    .pipe(dest("assets/js"));
}

// Template Js: Optimize
function templateJs(done) {
  const tasks = project.appTemplate.map(template => {
    const jsArray = template.js;
    const jsPageName = template.pageName.toLowerCase();

    return src(jsArray)
      .pipe(plumber({
        errorHandler: function (err) {
          console.error(`Error in ${jsPageName}.js: ${err.jsPageName}`);
          this.emit('end');
        }
      }))
      .pipe(concat(`${jsPageName}.min.js`))
      .pipe(terser())
      .pipe(dest("build"))
  });
  return merge(tasks).on('end', done);
}


// JavaScript Linting
function lintJs() {
  return src(['assets/js/**/*.js', '!node_modules/**', '!assets/js/app.js'])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}

// Clean folders
function cleanTask() {
  console.log("-> Cleaning build and genetated css files");
  return src(["build", "assets/css/*.css", "assets/css/*.map"], { read: false, allowEmpty: true })
    .pipe(clean({
      force: true,
    }));
};


// Task Watch
const watchFilesTask = () => {
  watch("assets/sass/**/*.scss", minifySass);
  watch(project.app.js, globalJs);
  watch(['assets/js/**/*.js', '!assets/js/custom.js'], templateJs);
};

// Task Composition
const defaultTask = series(parallel(minifySass, globalJs, templateJs));
const watchTask = series(defaultTask, watchFilesTask);

// Export Tasks
exports.default = defaultTask;
exports.watch = watchTask;

// Export Linting Tasks
exports.lintJs = lintJs;
exports.clean = cleanTask;