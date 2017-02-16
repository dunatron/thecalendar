/**
 * Created by Heath on 16/02/17.
 */
/**
 * Created by admin on 8/02/17.
 */
var drawHapp = SVG('happSVGLogo').size('100%', '100%').attr({position:'relative', fill: 'none', stroke: '#231f20', 'stroke-width': '3px'});


var happBox  = drawHapp.viewbox(0, 0, 1280, 800);

var orangeBox_Timeout = 750;
var H_timeout = 750;



//letW
//letH
//letA
//letT
//letS
// Orange Box
var orangeBox = drawHapp.path('M1031.253,456.586c0,17.498-14.187,31.683-31.683,31.683H672.424c-17.498,0-31.685-14.185-31.685-31.683V292.89c0-17.501,14.187-31.684,31.685-31.684H999.57c17.496,0,31.683,14.183,31.683,31.684V456.586z')
    .attr({
        class:'orangeBox',
        stroke:'#FFF',
        fill:'#FF6633'
    })
    .attr({'stroke-miterlimit':10});
// letH2
var letH2 = drawHapp.path('M742.826,328.694v79.047c0,5.84-4.889,10.729-10.729,10.729c-5.976,0-10.729-4.89-10.729-10.729v-30.017h-29.338v30.017c0,5.84-4.752,10.729-10.729,10.729c-5.839,0-10.728-4.89-10.728-10.729v-79.047c0-5.84,4.889-10.73,10.728-10.73c5.978,0,10.729,4.89,10.729,10.73v30.015h29.338v-30.015c0-5.84,4.754-10.73,10.729-10.73C737.938,317.964,742.826,322.854,742.826,328.694z')
    .attr({
        class:'letH2',
        stroke:'#FFFFFF',
        fill:'#FFFFFF',
        'stroke-miterlimit':10
    });
// letA2
var letA2 = drawHapp.path('M821.872,360.747v47.538c0,5.568-4.619,10.187-10.188,10.187c-2.987,0-5.704-1.359-7.606-3.261c-5.159,2.717-10.729,4.346-16.976,4.346c-19.151,0-34.771-15.618-34.771-34.77c0-19.149,15.619-34.77,34.771-34.77c5.975,0,11.543,1.631,16.705,4.347c1.901-2.444,4.617-3.802,7.877-3.802C817.253,350.561,821.872,355.178,821.872,360.747zM800.276,384.786c0-7.333-5.84-13.174-13.174-13.174c-7.335,0-13.175,5.841-13.175,13.174c0,7.335,5.84,13.175,13.175,13.175C794.437,397.961,800.276,392.121,800.276,384.786z')
    .attr({
        class:'letA2',
        fill:'#FFFFFF'
    });
//letP
var letP = drawHapp.path('M867.504,419.014c-4.618,0-9.1-0.951-13.175-2.58v12.63c0,5.84-4.754,10.73-10.729,10.73h-0.951c-5.433-0.271-9.914-4.754-9.914-10.322v-68.725c0-5.568,4.617-10.186,10.186-10.186c3.124,0,5.705,1.222,7.605,3.259c5.026-2.715,10.866-4.346,16.979-4.346c19.15,0,34.77,15.618,34.77,34.77S886.654,419.014,867.504,419.014z M867.504,371.07c-7.335,0-13.175,5.839-13.175,13.174c0,7.334,5.84,13.174,13.175,13.174c7.334,0,13.174-5.84,13.174-13.174C880.678,376.909,874.838,371.07,867.504,371.07z')
    .attr({
        class:'letP',
        fill:'#FFFFFF'
    });
//letP2
var letP2 = drawHapp.path('M944.512,419.014c-4.618,0-9.1-0.951-13.175-2.58v12.63c0,5.84-4.754,10.73-10.729,10.73h-0.951c-5.433-0.271-9.914-4.754-9.914-10.322v-68.725c0-5.568,4.617-10.186,10.186-10.186c3.124,0,5.705,1.222,7.605,3.259c5.026-2.715,10.866-4.346,16.979-4.346c19.15,0,34.77,15.618,34.77,34.77S963.662,419.014,944.512,419.014z M944.512,371.07c-7.335,0-13.175,5.839-13.175,13.174c0,7.334,5.84,13.174,13.175,13.174c7.334,0,13.174-5.84,13.174-13.174C957.686,376.909,951.846,371.07,944.512,371.07z')
    .attr({
        class:'letP2',
        fill:'#FFFFFF'
    });

//letA2

// HAPP config
var orangeBoxPath = document.querySelector('.orangeBox');// orangeBox conf
var orangeBoxLength = orangeBox.length();
// H2
var letH2Path = document.querySelector('.letH2');// letH conf
var letH2Length = letH2.length();
//A2
var letA2Path = document.querySelector('.letA2');// letH conf
var letA2Length = letH2.length();
//P
var letPPath = document.querySelector('.letP');// letH conf
var letPLength = letP2.length();
//P2
var letP2Path = document.querySelector('.letP2');// letH conf
var letP2Length = letP2.length();

setupOrangeBox();
setupLetH2();
setupLetA2();
setupLetP();
setupLetP2();

/**
 * Setup Letter Start points | HAPP
 */
function setupOrangeBox() {
    // Clear J & setup start
    orangeBoxPath.style.transition = orangeBoxPath.style.WebkitTransition = 'none';
    orangeBoxPath.style.strokeDasharray = orangeBoxLength + ' ' + orangeBoxLength;
    orangeBoxPath.style.strokeDashoffset = orangeBoxLength;
    orangeBoxPath.style.fill = 'none';
}

function setupLetH2() {
    // Clear H & setup start
    letH2Path.style.transition = letH2Path.style.WebkitTransition = 'none';
    letH2Path.style.strokeDasharray = letH2Length + ' ' + letH2Length;
    letH2Path.style.strokeDashoffset = letH2Length;
    letH2Path.style.fill = 'none';
}
function setupLetA2() {
    // Clear H & setup start
    letA2Path.style.transition = letA2Path.style.WebkitTransition = 'none';
    letA2Path.style.strokeDasharray = letA2Length + ' ' + letA2Length;
    letA2Path.style.strokeDashoffset = letA2Length;
    letA2Path.style.fill = 'none';
}
function setupLetP() {
    // Clear H & setup start
    letPPath.style.transition = letPPath.style.WebkitTransition = 'none';
    letPPath.style.strokeDasharray = letPLength + ' ' + letPLength;
    letPPath.style.strokeDashoffset = letPLength;
    letPPath.style.fill = 'none';
}
function setupLetP2() {
    // Clear H & setup start
    letP2Path.style.transition = letP2Path.style.WebkitTransition = 'none';
    letP2Path.style.strokeDasharray = letP2Length + ' ' + letP2Length;
    letP2Path.style.strokeDashoffset = letP2Length;
    letP2Path.style.fill = 'none';
}

/**
 * animate draw letters | HAPP
 */
function animateOrangeBox(callback) {
    // picks up the starting position before animating
    orangeBoxPath.getBoundingClientRect();
    // Define our transition
    orangeBoxPath.style.transition = orangeBoxPath.style.WebkitTransition =
        'stroke-dashoffset ' +4.5+'s ease-out';
    // Go!
    orangeBoxPath.style.strokeDashoffset = '0';

    setTimeout(function () {
        callback();
    }, orangeBox_Timeout);
}

function animateLetH2(callback) {
    // picks up the starting position before animating
    letH2Path.getBoundingClientRect();
    // Define our transition
    letH2Path.style.transition = letH2Path.style.WebkitTransition =
        'stroke-dashoffset ' +2.5+'s ease-out';
    // Go!
    letH2Path.style.strokeDashoffset = '0';

    setTimeout(function () {
        callback();
    }, H_timeout);
}

function animateLetA2(callback) {
    // picks up the starting position before animating
    letA2Path.getBoundingClientRect();
    // Define our transition
    letA2Path.style.transition = letA2Path.style.WebkitTransition =
        'stroke-dashoffset ' +2.5+'s ease-out';
    // Go!
    letA2Path.style.strokeDashoffset = '0';

    setTimeout(function () {
        callback();
    }, H_timeout);
}
function animateLetP(callback) {
    // picks up the starting position before animating
    letPPath.getBoundingClientRect();
    // Define our transition
    letPPath.style.transition = letPPath.style.WebkitTransition =
        'stroke-dashoffset ' +2.5+'s ease-out';
    // Go!
    letPPath.style.strokeDashoffset = '0';

    setTimeout(function () {
        callback();
    }, H_timeout);
}
function animateLetP2(callback) {
    // picks up the starting position before animating
    letP2Path.getBoundingClientRect();
    // Define our transition
    letP2Path.style.transition = letP2Path.style.WebkitTransition =
        'stroke-dashoffset ' +2.5+'s ease-out';
    // Go!
    letP2Path.style.strokeDashoffset = '0';

    setTimeout(function () {
        callback();
    }, H_timeout);
}

animateOrangeBox(function(){
    animateLetH2(function(){
        animateLetA2(function () {
            animateLetP(function () {
                animateLetP2(function () {
                    fillColor()
                })
            })
        })
    })
});

function fillColor(){
    orangeBoxPath.style.fill = 'FF6633';
    letP2Path.style.fill = '#FFF';
}

/**
 * Calculate polygon lengths
 * @param el
 * @returns {number}
 */
function getPolygonLength(el){
    var points = el.attr('points');
    points = points.split(" ");
    var x1 = null, x2, y1 = null, y2 , lineLength = 0, x3, y3;
    for(var i = 0; i < points.length; i++){
        var coords = points[i].split(",");
        if(x1 == null && y1 == null){

            if(/(\r\n|\n|\r)/gm.test(coords[0])){
                coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
                coords[0] = coords[0].replace(/\s+/g,"");
            }

            if(/(\r\n|\n|\r)/gm.test(coords[1])){
                coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
                coords[0] = coords[1].replace(/\s+/g,"");
            }

            x1 = coords[0];
            y1 = coords[1];
            x3 = coords[0];
            y3 = coords[1];

        }else{

            if(coords[0] != "" && coords[1] != ""){

                if(/(\r\n|\n|\r)/gm.test(coords[0])){
                    coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
                    coords[0] = coords[0].replace(/\s+/g,"");
                }

                if(/(\r\n|\n|\r)/gm.test(coords[1])){
                    coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
                    coords[0] = coords[1].replace(/\s+/g,"");
                }

                x2 = coords[0];
                y2 = coords[1];

                lineLength += Math.sqrt(Math.pow((x2-x1), 2)+Math.pow((y2-y1),2));

                x1 = x2;
                y1 = y2;
                if(i == points.length-2){
                    lineLength += Math.sqrt(Math.pow((x3-x1), 2)+Math.pow((y3-y1),2));
                }

            }
        }

    }
    return lineLength;

}

/**
 * calculate rect length
 * @param el
 * @returns {number}
 */
function getRectLength(el){
    var w = el.attr('width');
    var h = el.attr('height');

    return (w*2)+(h*2);
}



