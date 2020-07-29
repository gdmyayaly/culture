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
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { TeamComponent } from './pages/admin/team/team.component';
import { ChartsModule } from 'ng2-charts';
import { SevenlastdayComponent } from './diagramme/sevenlastday/sevenlastday.component';
import { MoisComponent } from './diagramme/mois/mois.component';
import { AnneeComponent } from './diagramme/annee/annee.component';
import { CardpresentationComponent } from './diagramme/cardpresentation/cardpresentation.component';
import { AddteamComponent } from './pages/admin/team/addteam/addteam.component';
import { QuestionComponent } from './pages/question/question.component';
import { SessionComponent } from './pages/admin/session/session.component';
import { EvaluationComponent } from './pages/question/evaluation/evaluation.component';
import { JwtModule } from "@auth0/angular-jwt";
import { AuthService } from './service/auth.service';
import {InterceptorService} from './service/interceptor.service';
import {AuthGuardService} from './service/auth-guard.service';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
export function tokenGetter() {
  return localStorage.getItem("token");
}
import { ListeamComponent } from './pages/admin/team/listeam/listeam.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material/material.module';
import { LoaderComponent } from './layout/loader/loader.component';
import { AnneComponent } from './diagrammeteam/anne/anne.component';
import { SevenComponent } from './diagrammeteam/seven/seven.component';
import { ChoixdateComponent } from './modal/choixdate/choixdate.component';
import { ArticleComponent } from './pages/blog/article/article.component';
import { CreateComponent } from './pages/blog/create/create.component';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { TestsummerComponent } from './testsummer/testsummer.component';

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
    SessionComponent,
    EvaluationComponent,
    ListeamComponent,
    LoaderComponent,
    AnneComponent,
    SevenComponent,
    ChoixdateComponent,
    ArticleComponent,
    CreateComponent,
    CalendarComponent,
    TestsummerComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ChartsModule,
    ReactiveFormsModule,
    MaterialModule,
    FormsModule,
    JwtModule.forRoot({
      config: {
        tokenGetter: tokenGetter,
       // whitelistedDomains: ["example.com"],
       // blacklistedRoutes: ["http://example.com/examplebadroute/"],
      },
    }),
    BrowserAnimationsModule,
  ],
  providers: [AuthGuardService,AuthService,
    {
    provide:HTTP_INTERCEPTORS,
    useClass:InterceptorService,
    multi:true
  }
],
entryComponents:[ChoixdateComponent],
  bootstrap: [AppComponent]
})
export class AppModule { }
