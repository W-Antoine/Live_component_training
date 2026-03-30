import { Controller } from '@hotwired/stimulus';
import { marked } from 'marked';

export default class extends Controller {
    connect() {
        const raw = this.element.dataset.raw;
        this.element.innerHTML = marked.parse(raw);
    }
}
