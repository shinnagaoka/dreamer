import { Component, OnInit, ViewChild } from '@angular/core';
declare var google: any;

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-google',
    templateUrl: './google.component.html',
    styleUrls: ['./google.component.scss']
})
export class GoogleComponent implements OnInit {

    @ViewChild('agmMap') agmMap;

    lat: number = -12.043333;
    lng: number = -77.028333;
    zoom: number = 14;
    scrollwheel = false;

    lat2: number = -12.043333;
    lng2: number = -77.03;

    constructor(pt: PagetitleService) {
        pt.setTitle('Google Maps');
    }

    ngOnInit() {
        this.agmMap.mapReady.subscribe(map => {
            new google.maps.StreetViewPanorama(
                document.getElementById('panorama'),
                {
                    position: { lat: 42.3455, lng: -71.0983 },
                    pov: { heading: 165, pitch: 0 },
                    zoom: 1
                });
        });
    }

}
