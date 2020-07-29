import { Component, OnInit } from '@angular/core';
declare var $:any;
import * as $ from 'jquery';

import { FormControl, FormGroup } from '@angular/forms';
@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',
  styleUrls: ['./create.component.scss']
})
export class CreateComponent implements OnInit {
  blogForm: FormGroup;

  constructor( ){
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
    console.log('Données du formulaire...', this.blogForm.value);
  }
}
 