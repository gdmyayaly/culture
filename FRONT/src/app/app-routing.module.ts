import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { ListecollaborateurComponent } from './pages/admin/collaborateur/listecollaborateur/listecollaborateur.component';
import { AjoutcollaborateurComponent } from './pages/admin/collaborateur/ajoutcollaborateur/ajoutcollaborateur.component';
import { DetailcollaborateurComponent } from './pages/admin/collaborateur/detailcollaborateur/detailcollaborateur.component';
import { TeamComponent } from './pages/admin/team/team.component';
import { AddteamComponent } from './pages/admin/team/addteam/addteam.component';
import { QuestionComponent } from './pages/question/question.component';
import { SessionComponent } from './pages/admin/session/session.component';
import { EvaluationComponent } from './pages/question/evaluation/evaluation.component';
import { LoginComponent } from './pages/login/login.component';
import { ListeamComponent } from './pages/admin/team/listeam/listeam.component';
import { AuthGuardService } from './service/auth-guard.service';
import { ArticleComponent } from './pages/blog/article/article.component';
import { CreateComponent } from './pages/blog/create/create.component';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { TestsummerComponent } from './testsummer/testsummer.component';

const routes: Routes = [
  {path:'',component:LoginComponent},
  {path:'collaborateur',component:ListecollaborateurComponent,canActivate: [AuthGuardService] },
  {path:'collaborateur/add',component:AjoutcollaborateurComponent,canActivate: [AuthGuardService] },
  {path:'collaborateur/detail/:id',component:DetailcollaborateurComponent,canActivate: [AuthGuardService] },
  {path:'team',component:TeamComponent,canActivate: [AuthGuardService] },
  {path:'addteam',component:AddteamComponent,canActivate: [AuthGuardService] },
  {path:'question',component:QuestionComponent,canActivate: [AuthGuardService] },
  {path:'session',component:SessionComponent,canActivate: [AuthGuardService] },
  {path:'evaluation/:id',component:EvaluationComponent,canActivate: [AuthGuardService] },
  // {path:'login',component:LoginComponent}
  {path:'login',component:LoginComponent,canActivate: [AuthGuardService] },
  {path:'team/detail/:id',component:ListeamComponent,canActivate: [AuthGuardService] },
  {path:'blog',component:ArticleComponent,canActivate: [AuthGuardService]},
  {path:'createblog',component:CreateComponent,canActivate: [AuthGuardService] },
  {path:'calendar',component:CalendarComponent,canActivate: [AuthGuardService] },
  {path:'test',component:TestsummerComponent,canActivate: [AuthGuardService] },
  { path: '**', component: LoginComponent },








];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
