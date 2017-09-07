import { OnInit, OnChanges, OnDestroy, Directive, ElementRef, Input, Output, SimpleChange, EventEmitter, AfterViewInit } from '@angular/core';

declare var $: any;

@Directive({
    selector: '[peity]'
})
export class PeityDirective implements AfterViewInit, OnChanges {

    @Input() type: string;
    @Input() data: any;
    @Input() options: any;
    chart = null;

    constructor(private element: ElementRef) { }

    ngAfterViewInit() {
        this.chart = $(this.element.nativeElement);
        this.chart.text(this.getData()).peity(this.type, this.options);
        // responsive
        $(window).resize(() => this.chart.peity(this.type, this.options));
    }

    ngOnChanges(changes: { [propertyName: string]: SimpleChange }) {
        if (this.chart && changes['data']) {
            this.chart.text(this.getData()).change();
        }
    }

    // If data is string, don't parse as array
    getData() {
        return (typeof this.data === 'string') ?
            this.data :
            this.data.join();
    }

}
