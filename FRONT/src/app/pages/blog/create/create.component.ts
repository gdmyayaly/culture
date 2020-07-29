import { Component, OnInit } from '@angular/core';
declare var $:any;
import * as $ from 'jquery';

import { FormControl, FormGroup } from '@angular/forms';
import { AdminService } from 'src/app/service/admin.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',
  styleUrls: ['./create.component.scss']
})
export class CreateComponent implements OnInit {
  blogForm: FormGroup;

  constructor(private admin:AdminService,private router:Router){
  }
  ngOnInit() {
    this.blogForm = new FormGroup({
      titre: new FormControl(),
      date: new FormControl(),
      image: new FormControl(),
      description: new FormControl(),
    });


    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({ tags: true });
    });

  

    $(document).ready(function() {
       $('#summernote').summernote({ 
          tabsize: 4,
           height: 200 });
     });


  }

  valider() {
    var t = (document.getElementById('summernote')as HTMLTextAreaElement).value;
    console.log(t);
    this.admin.datasummer=t;
    this.router.navigate(['test'])
    console.log('Données du formulaire...', this.blogForm.value);
  }
}
 