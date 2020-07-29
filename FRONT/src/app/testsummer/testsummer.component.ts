import { Component, OnInit } from '@angular/core';
import { AdminService } from '../service/admin.service';

@Component({
  selector: 'app-testsummer',
  templateUrl: './testsummer.component.html',
  styleUrls: ['./testsummer.component.scss']
})
export class TestsummerComponent implements OnInit {

  constructor(private admin:AdminService) { }

  ngOnInit() {
    document.getElementById('rien').innerHTML=this.admin.datasummer;
  }

}
