import {
    nodeTreeToSketchPage
} from '@brainly/html-sketchapp';
import copy from 'copy-to-clipboard';
import $ from 'jquery';

/**
 * Create asketch file.
 *
 * @param {HTMLElement} link
 * @param {HTMLElement} node
 */
function createSketch(link, node) {
    const page = nodeTreeToSketchPage(node);
    let name = node.className.split(' ').join('_');
    if (!name) {
        name = node.tagName;
    }
    if (name === 'div') {
        name = 'full';
    }
    page.setName('Styleguide: ' + name);
    link.download = 'styleguide-' + name + '.asketch.json';
    link.href = window.URL.createObjectURL(new Blob([JSON.stringify(page.toJSON())], {
        Type: 'application/json'
    }));

    copy(JSON.stringify(page.toJSON()));
}

$('.styleguide-download').click(function() {
    createSketch(this, $(this).closest('[data-sketch-download]').children().not('br').first().get(0));
});

$('.styleguide-download-full').click(function() {
    createSketch(this, $('body').find('[data-sketch-download]').first().get(0));
});
