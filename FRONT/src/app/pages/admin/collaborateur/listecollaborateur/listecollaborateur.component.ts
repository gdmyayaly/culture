import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';
import { Router,NavigationEnd, NavigationStart  } from '@angular/router';
@Component({
  selector: 'app-listecollaborateur',
  templateUrl: './listecollaborateur.component.html',
  styleUrls: ['./listecollaborateur.component.scss']
})
export class ListecollaborateurComponent implements OnInit {
  public user:any;
  constructor(private admin:AdminService,private route:Router) { }

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
    localStorage.setItem('userdetail',JSON.stringify(this.admin.userdetail));
  }
}
