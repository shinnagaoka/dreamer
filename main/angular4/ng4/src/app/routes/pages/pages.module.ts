import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AgmCoreModule } from '@agm/core';
import { CalendarModule } from 'angular-calendar';

import { SharedModule } from '../../shared/shared.module';

import { TimelineComponent } from './timeline/timeline.component';
import { InvoiceComponent } from './invoice/invoice.component';
import { PricingComponent } from './pricing/pricing.component';
import { ContactComponent } from './contact/contact.component';
import { WallComponent } from './wall/wall.component';
import { MailboxComponent } from './mailbox/mailbox.component';
import { MessagenewComponent } from './mailbox/messagenew/messagenew.component';
import { MessageviewComponent } from './mailbox/messageview/messageview.component';
import { ForumComponent } from './forum/forum.component';
import { FullmapComponent } from './fullmap/fullmap.component';
import { CalendarComponent } from './calendar/calendar.component';
import { PeopleComponent } from './people/people.component';

const routes: Routes = [
    { path: 'timeline', component: TimelineComponent },
    { path: 'invoice', component: InvoiceComponent },
    { path: 'pricing', component: PricingComponent },
    { path: 'contact', component: ContactComponent },
    { path: 'wall', component: WallComponent },
    { path: 'mailbox', component: MailboxComponent },
    { path: 'fullmap', component: FullmapComponent },
    { path: 'forum', component: ForumComponent },
    { path: 'calendar', component: CalendarComponent },
    { path: 'people', component: PeopleComponent }
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes),
        AgmCoreModule.forRoot({
            apiKey: 'AIzaSyBNs42Rt_CyxAqdbIBK0a5Ut83QiauESPA'
        }),
        CalendarModule.forRoot()
    ],
    declarations: [
        TimelineComponent,
        InvoiceComponent,
        PricingComponent,
        ContactComponent,
        WallComponent,
        MailboxComponent,
        MessagenewComponent,
        MessageviewComponent,
        ForumComponent,
        CalendarComponent,
        PeopleComponent,
        FullmapComponent
    ],
    exports: [
        RouterModule
    ]
})
export class PagesModule { }
