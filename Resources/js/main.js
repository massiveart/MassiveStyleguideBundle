import {
    nodeTreeToSketchPage
} from '@brainly/html-sketchapp';
import 'core-js/modules/es7.string.pad-start';

/**
 * Create styleguide.asketch.json file from the current page.
 *
 * @param {Event} event
 */
function createSketch(event) {
    const link = event.currentTarget;
    const node = document.body;
    const page = nodeTreeToSketchPage(node);
    const date = new Date();
    const dateString = date.getUTCFullYear() + '-'
        + (date.getUTCMonth() + 1).toString().padStart(2, '0') + '-'
        + date.getUTCDay().toString().padStart(2, '0');
    page.setName('Styleguide');
    link.download = 'styleguide-' + dateString + '.asketch.json';
    link.href = window.URL.createObjectURL(new Blob([JSON.stringify(page.toJSON())], {
        type: 'application/json'
    }));
}

document.querySelectorAll('[data-sketch-download]').forEach(function(link) {
    link.addEventListener('click', createSketch);
});
