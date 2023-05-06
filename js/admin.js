/* DB Tagcloud Preview in Admin Panel */

const dbTagcloudPreview = document.getElementById("db_tgcl_preview").getElementsByClassName("db-tagcloud")[0];
const dbTagcloudPreviewAnchors = dbTagcloudPreview.getElementsByTagName("a");
const dbTagcloudPreloader = document.getElementById("db_tgcl_preloader");
const dbTagcloudCols = document.getElementById("db_tgcl_cols");
const dbTagcloudFontsize = document.getElementById("db_tgcl_fontsize");
const dbTagcloudFontweight = document.getElementById("db_tgcl_fontweight");
const dbTagcloudBorderwidth = document.getElementById("db_tgcl_borderwidth");
const dbTagcloudUnderlined = document.getElementById("db_tgcl_underlined");
const dbTagcloudColor = document.getElementById("db_tgcl_color");
const dbTagcloudHover = document.getElementById("db_tgcl_color_hover");
const dbTagcloudBackground = document.getElementById("db_tgcl_background");
const dbTagcloudBackgroundHover = document.getElementById("db_tgcl_background_hover");


/* Number of columns */

let dbTagcloudColsOldNumber = dbTagcloudCols.value;

dbTagcloudCols.addEventListener('focus', function(){

    dbTagcloudColsOldNumber = dbTagcloudCols.value;

});

dbTagcloudCols.addEventListener('change', function(){

    let cols = dbTagcloudCols.value;

    dbTagcloudPreview.classList.remove("db-cols-" + dbTagcloudColsOldNumber);
    dbTagcloudPreview.classList.add("db-cols-" + cols);

});



/* Functions for style options */

function dbNewFontsize() {

    let fontsize = dbTagcloudFontsize.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )
        dbTagcloudPreviewAnchor.style.fontSize = fontsize + "px";

}


function dbNewFontweight() {

    let option = dbTagcloudFontweight.value;
    let fontweight;
    let fontstyle;

    switch (option) {
        case '0':
            fontweight = "400";
            fontstyle = "normal";
            break;
        case '1':
            fontweight = "700";
            fontstyle = "normal";
            break;
        case '2':
            fontweight = "400";
            fontstyle = "italic";
            break;
        case '3':
            fontweight = "700";
            fontstyle = "italic";
            break;
    }

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.fontWeight = fontweight;
            dbTagcloudPreviewAnchor.style.fontStyle = fontstyle;
        }

}


function dbNewBorderwidth() {

    let borderwidth = dbTagcloudBorderwidth.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

       dbTagcloudPreviewAnchor.style.borderWidth = borderwidth + "px";        

}


function dbNewUnderlined() {

    let underlined = dbTagcloudUnderlined.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

       if ( underlined === 1 ) dbTagcloudPreviewAnchor.style.textDecoration = "underline";
       else dbTagcloudPreviewAnchor.style.textDecoration = "none";

}



/* Run all functions for style options on load as old css might be cached */

window.onload = function () {

    dbNewFontsize();
    dbNewFontweight();
    dbNewBorderwidth();
    dbNewUnderlined();
    setTimeout( () => {
        dbTagcloudPreview.classList.remove("db-hidden");
        dbTagcloudPreloader.classList.add("db-hidden");
    }, 1500 );

};



/* Event Listeners for changing of style options */

dbTagcloudFontsize.addEventListener('change', dbNewFontsize);
dbTagcloudFontweight.addEventListener('change', dbNewFontweight);
dbTagcloudBorderwidth.addEventListener('change', dbNewBorderwidth);
dbTagcloudUnderlined.addEventListener('change', dbNewUnderlined);



/* WP Color Picker */

jQuery(document).ready(function($){
    $('.db-tgcl-color').wpColorPicker();
    $('.db-tgcl-color-hover').wpColorPicker();
    $('.db-tgcl-background').wpColorPicker();
    $('.db-tgcl-background-hover').wpColorPicker();
});

/* Changing color */

Object.defineProperty(dbTagcloudColor, "value", {
    set: function (t) {
       
    dbTagcloudColor.setAttribute('value',t);

    let color = dbTagcloudColor.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.color = color;
            dbTagcloudPreviewAnchor.style.borderColor = color;
        }
       
    },
    
    get: function(){

        return dbTagcloudColor.getAttribute('value');

    }

});



Object.defineProperty(dbTagcloudHover, "value", {
    set: function (t) {
       
    dbTagcloudHover.setAttribute('value',t);

    let color = dbTagcloudHover.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.color = color;
            dbTagcloudPreviewAnchor.style.borderColor = color;
        }
       
    },
    
    get: function(){

        return dbTagcloudHover.getAttribute('value');

    }

});



Object.defineProperty(dbTagcloudBackground, "value", {
    set: function (t) {
       
    dbTagcloudBackground.setAttribute('value',t);

    let color = dbTagcloudBackground.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.color = color;
            dbTagcloudPreviewAnchor.style.borderColor = color;
        }
       
    },
    
    get: function(){

        return dbTagcloudBackground.getAttribute('value');

    }

});



Object.defineProperty(dbTagcloudBackgroundHover, "value", {
    set: function (t) {
       
    dbTagcloudBackgroundHover.setAttribute('value',t);

    let color = dbTagcloudBackgroundHover.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.color = color;
            dbTagcloudPreviewAnchor.style.borderColor = color;
        }
       
    },
    
    get: function(){

        return dbTagcloudBackgroundHover.getAttribute('value');

    }

});