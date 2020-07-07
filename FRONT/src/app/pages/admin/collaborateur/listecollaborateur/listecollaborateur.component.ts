import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-listecollaborateur',
  templateUrl: './listecollaborateur.component.html',
  styleUrls: ['./listecollaborateur.component.scss']
})
export class ListecollaborateurComponent implements OnInit {
  public user:any;
  constructor(private admin:AdminService) { }

  ngOnInit() {
    this.admin.usergrow().subscribe(
      res=>{console.log(res);
        this.user=res.body
      },
      error=>{console.log(error);
      }
    )
  }
  choix(user){
    this.admin.userdetail=user;
  }
}
