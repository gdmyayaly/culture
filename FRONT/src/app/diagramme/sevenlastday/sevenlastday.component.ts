import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-sevenlastday',
  templateUrl: './sevenlastday.component.html',
  styleUrls: ['./sevenlastday.component.scss']
})
export class SevenlastdayComponent implements OnInit {
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

  public teamperseverance:any;
  public teamconfiance:any;
  public teamcollaboration:any;
  public teamautonomie:any;
  public teamproblemsolving:any;
  public teamtransmission:any;
  public teamperformance:any;

  public moyenneteamperseverance:any;
  public moyenneteamconfiance:any;
  public moyenneteamcollaboration:any;
  public moyenneteamautonomie:any;
  public moyenneteamproblemsolving:any;
  public moyenneteamtransmission:any;
  public moyenneteamperformance:any;

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
  constructor(private admin:AdminService) { }

  ngOnInit() {
    this.initialisationchart();
    this.admin.notesevenlastdays(this.admin.iduser).subscribe(
      res=>{
        this.datart=res.body;
         this.date=this.datart.date;
         this.perseverance=this.datart.perseverance;
         this.teamperseverance=this.datart.teamperseverance;
         this.chartPerseverance();
         this.confiance=this.datart.confiance;
         this.teamconfiance=this.datart.teamconfiance;
         this.chartConfiance();
         this.collaboration=this.datart.collaboration;
         this.teamcollaboration=this.datart.teamcollaboration;
         this.chartCollaboration();
         this.autonomie=this.datart.autonomie;
         this.teamautonomie=this.datart.teamautonomie;
         this.chartAutonomie();
         this.problemsolving=this.datart.problemsolving;
         this.teamproblemsolving=this.datart.teamproblemsolving;
         this.chartProblemsolving();
         this.transmission=this.datart.transmission;
         this.teamtransmission=this.datart.teamtransmission;
         this.chartTransmission();
         this.performance=this.datart.performance;
         this.teamperformance=this.datart.teamperformance;
         this.chartPerformance();
         this.loadmoyenne();
      },
      error=>{console.log(error);
      }
    )
    
  }
  loadmoyenne(){
    this.moyenneperseverance=0;
    this.moyenneconfiance=0;
    this.moyennecollaboration=0;
    this.moyenneautonomie=0;
    this.moyenneproblemsolving=0;
    this.moyennetransmission=0;
    this.moyenneperformance=0;
    this.moyenneteamperseverance=0;
    this.moyenneteamconfiance=0;
    this.moyenneteamcollaboration=0;
    this.moyenneteamautonomie=0;
    this.moyenneteamproblemsolving=0;
    this.moyenneteamtransmission=0;
    this.moyenneteamperformance=0;
    for (let index = 0; index < this.perseverance.length; index++) {
      this.moyenneperseverance=this.moyenneperseverance+this.perseverance[index];
      this.moyenneconfiance=this.moyenneconfiance+this.confiance[index];
      this.moyennecollaboration=this.moyennecollaboration+this.collaboration[index];
      this.moyenneautonomie=this.moyenneautonomie+this.autonomie[index];
      this.moyenneproblemsolving=this.moyenneproblemsolving+this.problemsolving[index];
      this.moyennetransmission=this.moyennetransmission+this.transmission[index];
      this.moyenneperformance=this.moyenneperformance+this.performance[index];
      this.moyenneteamperseverance=this.moyenneteamperseverance+this.teamperseverance[index];
      this.moyenneteamconfiance=this.moyenneteamconfiance+this.teamconfiance[index];
      this.moyenneteamcollaboration=this.moyenneteamcollaboration+this.teamcollaboration[index];
      this.moyenneteamautonomie=this.moyenneteamautonomie+this.teamautonomie[index];
      this.moyenneteamproblemsolving=this.moyenneteamproblemsolving+this.teamproblemsolving[index];
      this.moyenneteamtransmission=this.moyenneteamtransmission+this.teamtransmission[index];
      this.moyenneteamperformance=this.moyenneteamperformance+this.teamperformance[index];
    }
    this.moyenneperseverance=this.moyenneperseverance/7;
    this.moyenneconfiance=this.moyenneconfiance/7;
    this.moyennecollaboration=this.moyennecollaboration/7;
    this.moyenneautonomie=this.moyenneautonomie/7;
    this.moyenneproblemsolving=this.moyenneproblemsolving/7;
    this.moyennetransmission=this.moyennetransmission/7;
    this.moyenneperformance=this.moyenneperformance/7;
    this.moyenneteamperseverance=this.moyenneteamperseverance/7;
    this.moyenneteamconfiance=this.moyenneteamconfiance/7;
    this.moyenneteamcollaboration=this.moyenneteamcollaboration/7;
    this.moyenneteamautonomie=this.moyenneteamautonomie/7;
    this.moyenneteamproblemsolving=this.moyenneteamproblemsolving/7;
    this.moyenneteamtransmission=this.moyenneteamtransmission/7;
    this.moyenneteamperformance=this.moyenneteamperformance/7;
  }
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
