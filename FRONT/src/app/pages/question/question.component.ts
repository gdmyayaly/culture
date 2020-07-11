import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/service/auth.service';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-question',
  templateUrl: './question.component.html',
  styleUrls: ['./question.component.scss']
})
export class QuestionComponent implements OnInit {
  public team:any;
  constructor(private admin:AdminService) { }

  ngOnInit() {
    this.team=this.admin.listteam;
  }

}
