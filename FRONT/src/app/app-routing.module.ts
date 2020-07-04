import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { ListecollaborateurComponent } from './pages/admin/collaborateur/listecollaborateur/listecollaborateur.component';
import { AjoutcollaborateurComponent } from './pages/admin/collaborateur/ajoutcollaborateur/ajoutcollaborateur.component';
import { DetailcollaborateurComponent } from './pages/admin/collaborateur/detailcollaborateur/detailcollaborateur.component';
import { TeamComponent } from './pages/admin/team/team.component';


const routes: Routes = [
  {path:'',component:ListecollaborateurComponent},
  {path:'collaborateur/add',component:AjoutcollaborateurComponent},
  {path:'collaborateur/detail/:id',component:DetailcollaborateurComponent},
  {path:'team',component:TeamComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
