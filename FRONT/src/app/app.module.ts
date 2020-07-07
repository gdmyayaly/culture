import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './layout/header/header.component';
import { SidebarComponent } from './layout/sidebar/sidebar.component';
import { FooterComponent } from './layout/footer/footer.component';
import { LoginComponent } from './pages/login/login.component';
import { HomeComponent } from './pages/home/home.component';
import { ListecollaborateurComponent } from './pages/admin/collaborateur/listecollaborateur/listecollaborateur.component';
import { AjoutcollaborateurComponent } from './pages/admin/collaborateur/ajoutcollaborateur/ajoutcollaborateur.component';
import { DetailcollaborateurComponent } from './pages/admin/collaborateur/detailcollaborateur/detailcollaborateur.component';
import { HttpClientModule } from '@angular/common/http';
import { TeamComponent } from './pages/admin/team/team.component';
import { ChartsModule } from 'ng2-charts';
import { SevenlastdayComponent } from './diagramme/sevenlastday/sevenlastday.component';
import { MoisComponent } from './diagramme/mois/mois.component';
import { AnneeComponent } from './diagramme/annee/annee.component';
import { CardpresentationComponent } from './diagramme/cardpresentation/cardpresentation.component';
import { AddteamComponent } from './pages/admin/team/addteam/addteam.component';
import { QuestionComponent } from './pages/question/question.component';
import { AddsessionComponent } from './pages/session/addsession/addsession.component';
import { SessionComponent } from './pages/admin/session/session.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent,
    LoginComponent,
    HomeComponent,
    ListecollaborateurComponent,
    AjoutcollaborateurComponent,
    DetailcollaborateurComponent,
    TeamComponent,
    SevenlastdayComponent,
    MoisComponent,
    AnneeComponent,
    CardpresentationComponent,
    AddteamComponent,
    QuestionComponent,
    AddsessionComponent,
    SessionComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ChartsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
