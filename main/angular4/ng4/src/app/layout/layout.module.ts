import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { SharedModule } from '../shared/shared.module';
import { LayoutComponent } from './layout.component';
import { HeaderComponent } from './header/header.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { SearchComponent } from './header/search/search.component';
import { FooterComponent } from './footer/footer.component';
import { SettingsComponent } from './settings/settings.component';

@NgModule({
    imports: [
        RouterModule,
        SharedModule
    ],
    declarations: [
        LayoutComponent,
        SidebarComponent,
        HeaderComponent,
        SearchComponent,
        FooterComponent,
        SettingsComponent,
    ],
    exports: [
        LayoutComponent,
        SidebarComponent,
        HeaderComponent,
        SearchComponent,
        SettingsComponent,
    ]
})
export class LayoutModule { }
