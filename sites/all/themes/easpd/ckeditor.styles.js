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
        /* inline styles */
        { name : 'Blue'      , element: 'span', attributes: { 'class': 'bleu' } },
        { name : 'Pale Blue' , element: 'span', attributes: { 'class': 'bleu-pale' } },
        { name : 'Light Blue', element: 'span', attributes: { 'class': 'bleu-clair' } },
        { name : 'Green'     , element: 'span', attributes: { 'class': 'vert' } },
        { name : 'Turquoise' , element: 'span', attributes: { 'class': 'turquoise' } },
        { name : 'Purple'    , element: 'span', attributes: { 'class': 'violet' } },
        { name : 'Orange'    , element: 'span', attributes: { 'class': 'orange' } },

        /* block styles */
        // { name : 'Red Box'         , element: 'div', attributes:{ 'class': 'boite-rouge' } },
        { name : 'Blue Title'      , element: 'h2', attributes: { 'class': 'bloc-bleu' } },
        { name : 'Pale Blue Title' , element: 'h2', attributes: { 'class': 'bloc-bleu-pale' } },
        { name : 'Light Blue Title', element: 'h2', attributes: { 'class': 'bloc-bleu-clair' } },
        { name : 'Green Title'     , element: 'h2', attributes: { 'class': 'bloc-vert' } },
        { name : 'Turquoise Title' , element: 'h2', attributes: { 'class': 'bloc-turquoise' } },
        { name : 'Purple Title'    , element: 'h2', attributes: { 'class': 'bloc-violet' } },
        { name : 'Orange Title'    , element: 'h2', attributes: { 'class': 'bloc-orange' } },

        { name : 'White Background', element: 'div', attributes: { 'class': 'white-bg' } },

    ]);
}
