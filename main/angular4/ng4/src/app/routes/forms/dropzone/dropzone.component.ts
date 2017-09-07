import { Component, OnInit, ViewEncapsulation, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import * as Dropzone from 'dropzone';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

// Prevent Dropzone from auto discovering
// This is useful when you want to create the
// Dropzone programmatically later
Dropzone.autoDiscover = false;

@Component({
    selector: 'app-dropzone',
    templateUrl: './dropzone.component.html',
    styleUrls: ['./dropzone.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class DropzoneComponent implements OnInit, AfterViewInit {

    // Dropzone element
    @ViewChild('dropzoneArea') dropzoneArea: ElementRef;

    // Dropzone settings
    options = {
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        dictDefaultMessage: '<em class="ion-upload color-blue-grey-100 icon-2x"></em><br>Drop files here to upload', // default messages before first drop
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        accept: function(file, done) {
            if (file.name === 'justinbieber.jpg') {
                done('Naha, you dont. :)');
            } else {
                done();
            }
        },
        // dont use arrow functions so you can reference the dropzone with 'this' keyword
        init: function() {
            var dzHandler = this;

            this.element.querySelector('button[type=submit]').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dzHandler.processQueue();
            });
            this.on('addedfile', function(file) {
                console.log('Added file: ' + file.name);
            });
            this.on('removedfile', function(file) {
                console.log('Removed file: ' + file.name);
            });
            this.on('sendingmultiple', function() {

            });
            this.on('successmultiple', function(/*files, response*/) {

            });
            this.on('errormultiple', function(/*files, response*/) {

            });
        }
    };

    constructor(pt: PagetitleService) {
        pt.setTitle('Dropzone');
    }

    ngOnInit() { }

    ngAfterViewInit() {
        new Dropzone(this.dropzoneArea.nativeElement, this.options);
    }

}
