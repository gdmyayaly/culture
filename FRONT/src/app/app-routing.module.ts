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


const routes: Routes = [
  {path:'',component:ListecollaborateurComponent},
  {path:'collaborateur/add',component:AjoutcollaborateurComponent},
  {path:'collaborateur/detail/:id',component:DetailcollaborateurComponent},
  {path:'team',component:TeamComponent},
  {path:'addteam',component:AddteamComponent},
  {path:'question',component:QuestionComponent},
  {path:'session',component:SessionComponent},
  {path:'evaluation',component:EvaluationComponent},
  {path:'login',component:LoginComponent}





];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
