import { Component, OnInit, ViewEncapsulation } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

declare var $: any;
import '../../../../../node_modules/nestable/jquery.nestable.js';

@Component({
    selector: 'app-nestable',
    templateUrl: './nestable.component.html',
    styleUrls: ['./nestable.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class NestableComponent implements OnInit {

    nestable1;
    nestable2;
    output1 = '';
    output2 = '';

    constructor(pt: PagetitleService) {
        pt.setTitle('Nestable');
    }

    ngOnInit() {

        this.nestable1 = $('#nestable');
        this.nestable2 = $('#nestable2');

        // activate Nestable for list 1
        this.nestable1.nestable({
            group: 1
        })
            .on('change', this.updateOutput.bind(this));

        // activate Nestable for list 2
        this.nestable2.nestable({
            group: 1
        })
            .on('change', this.updateOutput.bind(this));

    }

    updateOutput() {
        this.output1 = JSON.stringify(this.nestable1.nestable('serialize'))
        this.output2 = JSON.stringify(this.nestable2.nestable('serialize'))
    }

}
