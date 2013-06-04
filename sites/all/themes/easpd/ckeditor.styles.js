/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [
        { name : 'Blue'      , element: 'span', attributes: { 'class': 'bleu' } },
        { name : 'Pale Blue' , element: 'span', attributes: { 'class': 'bleu-pale' } },
        { name : 'Light Blue', element: 'span', attributes: { 'class': 'bleu-clair' } },
        { name : 'Green'     , element: 'span', attributes: { 'class': 'vert' } },
        { name : 'Turquoise' , element: 'span', attributes: { 'class': 'turquoise' } },
        { name : 'Purple'    , element: 'span', attributes: { 'class': 'violet' } },
        { name : 'Orange'    , element: 'span', attributes: { 'class': 'orange' } },

    ]);
}
