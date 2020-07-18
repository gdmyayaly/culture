import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-listeam',
  templateUrl: './listeam.component.html',
  styleUrls: ['./listeam.component.scss']
})
export class ListeamComponent implements OnInit {
  public id:any;
  public nomteam:any;
  general: number
  moyennegeneral: number
  moyenneteamautonomie: number
  moyenneteamcollaboration: number
  moyenneteamconfiance: number
  moyenneteamperformance: number
  moyenneteamperseverance: number
  moyenneteamproblemsolving: number
  moyenneteamtransmission: number
  moyenneuserautonomie: number
  moyenneusercollaboration: number
  moyenneuserconfiance: number
  moyenneuserperformance: number
  moyenneuserperseverance: number
  moyenneuserproblemsolving: number
  moyenneusertransmission: number
  teamautonomie: number
  teamcollaboration: number
  teamconfiance: number
  teamperformance: number
  teamperseverance: number
  teamproblemsolving: number
  teamtransmission: number
  userautonomie: number
  usercollaboration: number
  userconfiance: number
  userperformance: number
  userperseverance: number
  userproblemsolving: number
  usertransmission: number;

  public datart:any;
  public date:any;
  public perseverance:any;
  public confiance:any;
  public collaboration:any;
  public autonomie:any;
  public problemsolving:any;
  public transmission:any;
  public performance:any;

  public moyenneperseverance:any;
  public moyenneconfiance:any;
  public moyennecollaboration:any;
  public moyenneautonomie:any;
  public moyenneproblemsolving:any;
  public moyennetransmission:any;
  public moyenneperformance:any;

  public teamperseverances:any;
  public teamconfiances:any;
  public teamcollaborations:any;
  public teamautonomies:any;
  public teamproblemsolvings:any;
  public teamtransmissions:any;
  public teamperformances:any;

  public moyenneteamperseverances:any;
  public moyenneteamconfiances:any;
  public moyenneteamcollaborations:any;
  public moyenneteamautonomies:any;
  public moyenneteamproblemsolvings:any;
  public moyenneteamtransmissions:any;
  public moyenneteamperformances:any;

  public barChartOptionsperseverance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,
    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsperseverance:any;
  public barChartTypeperseverance :any;
  public barChartLegendperseverance:any;
  public barChartDataperseverance;
  public barChartOptionsconfiance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsconfiance:any;
  public barChartTypeconfiance :any;
  public barChartLegendconfiance:any;
  public barChartDataconfiance;

  public barChartOptionscollaboration = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelscollaboration:any;
  public barChartTypecollaboration :any;
  public barChartLegendcollaboration:any;
  public barChartDatacollaboration;

  public barChartOptionsautonomie = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsautonomie:any;
  public barChartTypeautonomie :any;
  public barChartLegendautonomie:any;
  public barChartDataautonomie;

  public barChartOptionsproblemsolving = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsproblemsolving:any;
  public barChartTypeproblemsolving :any;
  public barChartLegendproblemsolving:any;
  public barChartDataproblemsolving;

  public barChartOptionstransmission = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelstransmission:any;
  public barChartTypetransmission :any;
  public barChartLegendtransmission:any;
  public barChartDatatransmission;

  public barChartOptionsperformance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsperformance:any;
  public barChartTypeperformance :any;
  public barChartLegendperformance:any;
  public barChartDataperformance;


  constructor(private activeroute:ActivatedRoute,public admin:AdminService) { }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    console.log(this.id);
    if (this.id==1) {
      this.nomteam="Team Business";
      this.moyennegeneral=0
      this.moyenneteamautonomie=1
      this.moyenneteamcollaboration=3
      this.moyenneteamconfiance=4
      this.moyenneteamperformance=5
      this.moyenneteamperseverance=6
      this.moyenneteamproblemsolving=7
      this.moyenneteamtransmission=8
      this.moyenneuserautonomie=10
      this.moyenneusercollaboration=11
      this.moyenneuserconfiance=12
      this.moyenneuserperformance=13
      this.moyenneuserperseverance=14
      this.moyenneuserproblemsolving=15
      this.moyenneusertransmission=16
      this.teamautonomie=17
      this.teamcollaboration=18
      this.teamconfiance=19
      this.teamperformance=20
      this.teamperseverance=21
      this.teamproblemsolving=22
      this.teamtransmission=23
      this.userautonomie=24
      this.usercollaboration=25
      this.userconfiance=26
      this.userperformance=27
      this.userperseverance=28
      this.userproblemsolving=29
      this.usertransmission=30
      this.general=40;
      this.initialisationchart();
      let a={id:407}
      this.admin.notesevenlastdays(a).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==2){
      this.nomteam="grow academy";
            this.moyennegeneral=0
      this.moyenneteamautonomie=1
      this.moyenneteamcollaboration=3
      this.moyenneteamconfiance=4
      this.moyenneteamperformance=5
      this.moyenneteamperseverance=6
      this.moyenneteamproblemsolving=7
      this.moyenneteamtransmission=8
      this.moyenneuserautonomie=10
      this.moyenneusercollaboration=11
      this.moyenneuserconfiance=12
      this.moyenneuserperformance=13
      this.moyenneuserperseverance=70
      this.moyenneuserproblemsolving=15
      this.moyenneusertransmission=16
      this.teamautonomie=17
      this.teamcollaboration=18
      this.teamconfiance=19
      this.teamperformance=20
      this.teamperseverance=65
      this.teamproblemsolving=22
      this.teamtransmission=23
      this.userautonomie=24
      this.usercollaboration=25
      this.userconfiance=26
      this.userperformance=27
      this.userperseverance=70
      this.userproblemsolving=29
      this.usertransmission=30
      this.general=65
      this.initialisationchart();
      let a={id:403}
      this.admin.notesevenlastdays(a).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==3){
      this.nomteam="Team Créa";
            this.moyennegeneral=0
      this.moyenneteamautonomie=1
      this.moyenneteamcollaboration=3
      this.moyenneteamconfiance=4
      this.moyenneteamperformance=5
      this.moyenneteamperseverance=6
      this.moyenneteamproblemsolving=7
      this.moyenneteamtransmission=8
      this.moyenneuserautonomie=10
      this.moyenneusercollaboration=11
      this.moyenneuserconfiance=12
      this.moyenneuserperformance=13
      this.moyenneuserperseverance=14
      this.moyenneuserproblemsolving=15
      this.moyenneusertransmission=16
      this.teamautonomie=17
      this.teamcollaboration=18
      this.teamconfiance=19
      this.teamperformance=20
      this.teamperseverance=21
      this.teamproblemsolving=22
      this.teamtransmission=23
      this.userautonomie=24
      this.usercollaboration=25
      this.userconfiance=26
      this.userperformance=27
      this.userperseverance=28
      this.userproblemsolving=29
      this.usertransmission=30
      this.general=58
      this.initialisationchart();
      let a={id:402}
      this.admin.notesevenlastdays(a).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==4){
      this.nomteam="Team Tech";
      this.moyennegeneral=0
      this.moyenneteamautonomie=1
      this.moyenneteamcollaboration=3
      this.moyenneteamconfiance=4
      this.moyenneteamperformance=5
      this.moyenneteamperseverance=6
      this.moyenneteamproblemsolving=7
      this.moyenneteamtransmission=8
      this.moyenneuserautonomie=10
      this.moyenneusercollaboration=11
      this.moyenneuserconfiance=12
      this.moyenneuserperformance=13
      this.moyenneuserperseverance=14
      this.moyenneuserproblemsolving=15
      this.moyenneusertransmission=16
      this.teamautonomie=17
      this.teamcollaboration=18
      this.teamconfiance=19
      this.teamperformance=20
      this.teamperseverance=21
      this.teamproblemsolving=22
      this.teamtransmission=23
      this.userautonomie=24
      this.usercollaboration=25
      this.userconfiance=26
      this.userperformance=27
      this.userperseverance=28
      this.userproblemsolving=29
      this.usertransmission=30
      this.general=54
      this.initialisationchart();
      let a={id:412}
      this.admin.notesevenlastdays(a).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           //
        },
        error=>{console.log(error);
        }
      )
    }
  }
  // loadmoyenne(){
  //   this.moyenneperseverance=0;
  //   this.moyenneconfiance=0;
  //   this.moyennecollaboration=0;
  //   this.moyenneautonomie=0;
  //   this.moyenneproblemsolving=0;
  //   this.moyennetransmission=0;
  //   this.moyenneperformance=0;
  //   this.moyenneteamperseverance=0;
  //   this.moyenneteamconfiance=0;
  //   this.moyenneteamcollaboration=0;
  //   this.moyenneteamautonomie=0;
  //   this.moyenneteamproblemsolving=0;
  //   this.moyenneteamtransmission=0;
  //   this.moyenneteamperformance=0;
  //   for (let index = 0; index < this.perseverance.length; index++) {
  //     this.moyenneperseverance=this.moyenneperseverance+this.perseverance[index];
  //     this.moyenneconfiance=this.moyenneconfiance+this.confiance[index];
  //     this.moyennecollaboration=this.moyennecollaboration+this.collaboration[index];
  //     this.moyenneautonomie=this.moyenneautonomie+this.autonomie[index];
  //     this.moyenneproblemsolving=this.moyenneproblemsolving+this.problemsolving[index];
  //     this.moyennetransmission=this.moyennetransmission+this.transmission[index];
  //     this.moyenneperformance=this.moyenneperformance+this.performance[index];
  //     this.moyenneteamperseverance=this.moyenneteamperseverance+this.teamperseverance[index];
  //     this.moyenneteamconfiance=this.moyenneteamconfiance+this.teamconfiance[index];
  //     this.moyenneteamcollaboration=this.moyenneteamcollaboration+this.teamcollaboration[index];
  //     this.moyenneteamautonomie=this.moyenneteamautonomie+this.teamautonomie[index];
  //     this.moyenneteamproblemsolving=this.moyenneteamproblemsolving+this.teamproblemsolving[index];
  //     this.moyenneteamtransmission=this.moyenneteamtransmission+this.teamtransmission[index];
  //     this.moyenneteamperformance=this.moyenneteamperformance+this.teamperformance[index];
  //   }
  //   this.moyenneperseverance=this.moyenneperseverance/7;
  //   this.moyenneconfiance=this.moyenneconfiance/7;
  //   this.moyennecollaboration=this.moyennecollaboration/7;
  //   this.moyenneautonomie=this.moyenneautonomie/7;
  //   this.moyenneproblemsolving=this.moyenneproblemsolving/7;
  //   this.moyennetransmission=this.moyennetransmission/7;
  //   this.moyenneperformance=this.moyenneperformance/7;
  //   this.moyenneteamperseverance=this.moyenneteamperseverance/7;
  //   this.moyenneteamconfiance=this.moyenneteamconfiance/7;
  //   this.moyenneteamcollaboration=this.moyenneteamcollaboration/7;
  //   this.moyenneteamautonomie=this.moyenneteamautonomie/7;
  //   this.moyenneteamproblemsolving=this.moyenneteamproblemsolving/7;
  //   this.moyenneteamtransmission=this.moyenneteamtransmission/7;
  //   this.moyenneteamperformance=this.moyenneteamperformance/7;
  // }
  chartPerseverance(){
    console.log(this.perseverance);
    console.log(this.teamperseverance);
    this.barChartLabelsperseverance = this.date;
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: this.perseverance, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamperseverance, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"},
     
   ];
  }

   chartConfiance(){
    this.barChartLabelsconfiance = this.date;
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: this.confiance, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamconfiance, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
  }
 
  chartCollaboration(){
    this.barChartLabelscollaboration = this.date;
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: this.collaboration, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamcollaboration, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
 }

 chartAutonomie(){
  this.barChartLabelsautonomie = this.date;
  this.barChartTypeautonomie = 'bar';
  this.barChartLegendautonomie = true;
  this.barChartDataautonomie = [
   {data: this.autonomie, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamautonomie, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartProblemsolving(){
  this.barChartLabelsproblemsolving = this.date;
  this.barChartTypeproblemsolving = 'bar';
  this.barChartLegendproblemsolving = true;
  this.barChartDataproblemsolving = [
   {data: this.problemsolving, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamproblemsolving, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartTransmission(){
  this.barChartLabelstransmission = this.date;
  this.barChartTypetransmission = 'bar';
  this.barChartLegendtransmission = true;
  this.barChartDatatransmission = [
   {data: this.transmission, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamtransmission, label: 'Team',backgroundColor: "grey"}
 ];
 }
 chartPerformance(){
  this.barChartLabelsperformance = this.date;
  this.barChartTypeperformance = 'bar';
  this.barChartLegendperformance = true;
  this.barChartDataperformance = [
   {data: this.performance, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamperformance, label: 'Team',backgroundColor: "grey",hoverBackgroundColor:"grey"}
 ];
  }

  initialisationchart(){
    this.barChartLabelsperseverance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"},
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "grey"}
    ];
  
    this.barChartLabelsconfiance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelscollaboration = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsautonomie = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeautonomie = 'bar';
    this.barChartLegendautonomie = true;
    this.barChartDataautonomie = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsproblemsolving = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeproblemsolving = 'bar';
    this.barChartLegendproblemsolving = true;
    this.barChartDataproblemsolving = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelstransmission = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypetransmission = 'bar';
    this.barChartLegendtransmission = true;
    this.barChartDatatransmission = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsperformance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeperformance = 'bar';
    this.barChartLegendperformance = true;
    this.barChartDataperformance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  }

}
