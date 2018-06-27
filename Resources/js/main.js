import {
    nodeTreeToSketchPage
} from '@brainly/html-sketchapp';
import 'core-js/modules/es7.string.pad-start';
import $ from 'jquery';

function createSketch(link, node) {
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

$('.styleguide-download').click(function() {
    createSketch(this, $(this).closest('[data-sketch-download]').children().first().get(0));
});

$('.styleguide-download-full').click(function() {
    createSketch(this, $('body').find('[data-sketch-download]').first().get(0));
});
