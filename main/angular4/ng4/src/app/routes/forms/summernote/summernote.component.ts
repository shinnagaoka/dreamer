import { Component, OnInit, ViewChild, ElementRef, ViewEncapsulation } from '@angular/core';
declare var $: any;

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-summernote',
    templateUrl: './summernote.component.html',
    styleUrls: ['./summernote.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class SummernoteComponent implements OnInit {

    @ViewChild('summernote') summernote: ElementRef;
    @ViewChild('summernoteAir') summernoteAir: ElementRef;

    contents: string;
    contents2: string;

    constructor(pt: PagetitleService) {
        pt.setTitle('Summernote');
    }

    ngOnInit() {

        $(this.summernote.nativeElement).summernote({
            height: 380,
            dialogsInBody: true,
            callbacks: {
                onChange: (contents, $editable) => {
                    this.contents = contents;
                }
            }
        });

        $(this.summernoteAir.nativeElement).summernote({
            airMode: true,
            dialogsInBody: true,
            callbacks: {
                onChange: (contents, $editable) => {
                    this.contents2 = contents;
                }
            }
        });

        // Hide the initial popovers that display
        $('.note-popover').css({
            'display': 'none'
        });
    }

}
