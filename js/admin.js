/* DB Tagcloud Preview in Admin Panel */

const dbTagcloudPreview = document.getElementById("db_tgcl_preview").getElementsByClassName("db-tagcloud")[0];
const dbTagcloudPreviewAnchors = dbTagcloudPreview.getElementsByTagName("a");
const dbTagcloudPreloader = document.getElementById("db_tgcl_preloader");
const dbTagcloudCols = document.getElementById("db_tgcl_cols");
const dbTagcloudFontsize = document.getElementById("db_tgcl_fontsize");
const dbTagcloudFontweight = document.getElementById("db_tgcl_fontweight");
const dbTagcloudBorderwidth = document.getElementById("db_tgcl_borderwidth");
const dbTagcloudUnderlined = document.getElementById("db_tgcl_underlined");
const dbTagcloudUnderlinedHover = document.getElementById("db_tgcl_underlined_hover");
const dbTagcloudColor = document.getElementById("db_tgcl_color");
const dbTagcloudColorHover = document.getElementById("db_tgcl_color_hover");
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
    underlined = ( underlined === '1' ? "underline" : "none");

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.textDecoration = underlined;
            dbTagcloudPreviewAnchor.addEventListener('mouseout', function()
    
                {
                    dbTagcloudPreviewAnchor.style.textDecoration = underlined;
                });
        }

}


function dbNewUnderlinedHover() {

    let underlined = dbTagcloudUnderlinedHover.value;
    underlined = ( underlined === '1' ? "underline" : "none");

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        dbTagcloudPreviewAnchor.addEventListener('mouseover', function()
    
            {
                dbTagcloudPreviewAnchor.style.textDecoration = underlined;
            });

}



/* Run all functions for style options on load as old css might be cached */

window.onload = function () {

    dbNewFontsize();
    dbNewFontweight();
    dbNewBorderwidth();
    dbNewUnderlined();
    dbNewUnderlinedHover();

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
dbTagcloudUnderlinedHover.addEventListener('change', dbNewUnderlinedHover);



/* WP Color Picker */

jQuery(document).ready(function($){
    $('.db-tgcl-color').wpColorPicker();
    $('.db-tgcl-color-hover').wpColorPicker();
    $('.db-tgcl-background').wpColorPicker();
    $('.db-tgcl-background-hover').wpColorPicker();
});


/* Color */

Object.defineProperty(dbTagcloudColor, "value", {
    set: function (t) {
       
    dbTagcloudColor.setAttribute('value',t);

    let color = dbTagcloudColor.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {
            dbTagcloudPreviewAnchor.style.color = color;
            dbTagcloudPreviewAnchor.style.borderColor = color;

            dbTagcloudPreviewAnchor.addEventListener('mouseout', function()
    
                {
                    dbTagcloudPreviewAnchor.style.color = color;
                    dbTagcloudPreviewAnchor.style.borderColor = color;
                });
        }
       
    },
    
    get: function(){

        return dbTagcloudColor.getAttribute('value');

    }

});


/* Color on Hover */

Object.defineProperty(dbTagcloudColorHover, "value", {
    set: function (t) {
       
    dbTagcloudColorHover.setAttribute('value',t);

    let color = dbTagcloudColorHover.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        dbTagcloudPreviewAnchor.addEventListener('mouseover', function()

            {
                dbTagcloudPreviewAnchor.style.color = color;
                dbTagcloudPreviewAnchor.style.borderColor = color;
            });
       
    },
    
    get: function(){

        return dbTagcloudColorHover.getAttribute('value');

    }

});


/* Background Color */

Object.defineProperty(dbTagcloudBackground, "value", {
    set: function (t) {
       
    dbTagcloudBackground.setAttribute('value',t);

    let color = dbTagcloudBackground.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        {

            dbTagcloudPreviewAnchor.style.backgroundColor = color;
    
            dbTagcloudPreviewAnchor.addEventListener('mouseout', function()
    
                {
                    dbTagcloudPreviewAnchor.style.backgroundColor = color;
                });

        }

    },
    
    get: function(){

        return dbTagcloudBackground.getAttribute('value');

    }

});


/* Background Color on Hover */

Object.defineProperty(dbTagcloudBackgroundHover, "value", {
    set: function (t) {
       
    dbTagcloudBackgroundHover.setAttribute('value',t);

    let color = dbTagcloudBackgroundHover.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

        dbTagcloudPreviewAnchor.addEventListener('mouseover', function()

            {
                dbTagcloudPreviewAnchor.style.backgroundColor = color;
            });
       
    },

    get: function(){

        return dbTagcloudBackgroundHover.getAttribute('value');

    }

});