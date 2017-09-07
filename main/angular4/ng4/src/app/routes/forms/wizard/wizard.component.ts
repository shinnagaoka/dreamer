import { Component, OnInit, ViewEncapsulation } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-wizard',
    templateUrl: './wizard.component.html',
    styleUrls: ['./wizard.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class WizardComponent implements OnInit {

    currentStep = 1;
    steps: Array<number> = [1, 2, 3, 4];

    constructor(pt: PagetitleService) {
        pt.setTitle('Form Wizard');
    }

    ngOnInit() {
    }

    stepNext() {
        if (!this.isLastStep())
            this.currentStep++;
    }

    stepPrev() {
        if (!this.isFirstStep() )
            this.currentStep--;
    }

    stepActive(stepNo: number) {
        return this.currentStep === stepNo;
    }

    isFirstStep() {
        return this.currentStep === Math.min(...this.steps);
    }

    isLastStep() {
        return this.currentStep === Math.max(...this.steps);
    }

}
