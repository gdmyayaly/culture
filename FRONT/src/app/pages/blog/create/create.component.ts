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
  public image="assets/defaut.png";
  public fileToUpload: File=null;
  constructor(private admin:AdminService,private router:Router){
  }
  ngOnInit() {
    this.blogForm = new FormGroup({
      titre: new FormControl(),
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
    this.blogForm.get('description').setValue(t);
    this.admin.createblog(this.blogForm.value,this.fileToUpload).subscribe(
      res=>{console.log(res);
      },
      error=>{console.error(error);
      }
    )
    // this.admin.datasummer=t;
     this.router.navigate(['blog'])
    console.log('Données du formulaire...', this.blogForm.value);
  }
  handleFileInputPP(file: FileList) {
    console.log(file);
    this.fileToUpload=file.item(0)
     var reader = new FileReader();
    reader.onload = (event: any) => {
      this.image = event.target.result;
    }
    reader.readAsDataURL(this.fileToUpload);
  }
}
 