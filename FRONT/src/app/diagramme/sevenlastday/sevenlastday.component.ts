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
  public barChartOptionsperseverance = {
    scaleShowVerticalLines: false,
    responsive: true,
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
    this.admin.lastevaluationdumois(this.admin.iduser).subscribe(
      res=>{console.log(res.body);
        this.datart=res.body;
         console.log("rt");
         console.log(res);
         
         this.date=this.datart.date;
         this.perseverance=this.datart.perseverance;
         this.chartPerseverance();
         this.confiance=this.datart.confiance;
         this.chartConfiance();
         this.collaboration=this.datart.collaboration;
         this.chartCollaboration();
         this.autonomie=this.datart.autonomie;
         this.chartAutonomie();
         this.problemsolving=this.datart.problemsolving;
         this.chartProblemsolving();
         this.transmission=this.datart.transmission;
         this.chartTransmission();
         this.performance=this.datart.performance;
         this.chartPerformance();
      },
      error=>{console.log(error);
      }
    )
    
  }
  chartPerseverance(){
    this.barChartLabelsperseverance = this.date;
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: this.perseverance, label: 'Perseverance',backgroundColor: "#FF4080"}
   ];
  }

   chartConfiance(){
    this.barChartLabelsconfiance = this.date;
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: this.confiance, label: 'Confiance',backgroundColor: "#FF4080"}
   ];
  }
 
  chartCollaboration(){
    this.barChartLabelscollaboration = this.date;
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: this.collaboration, label: 'Collaboration',backgroundColor: "#FF4080"}
   ];
 }

 chartAutonomie(){
  this.barChartLabelsautonomie = this.date;
  this.barChartTypeautonomie = 'bar';
  this.barChartLegendautonomie = true;
  this.barChartDataautonomie = [
   {data: this.autonomie, label: 'Autonomie',backgroundColor: "#FF4080"}
 ];
 }

 chartProblemsolving(){
  this.barChartLabelsproblemsolving = this.date;
  this.barChartTypeproblemsolving = 'bar';
  this.barChartLegendproblemsolving = true;
  this.barChartDataproblemsolving = [
   {data: this.problemsolving, label: 'problem solving',backgroundColor: "#FF4080"}
 ];
 }

 chartTransmission(){
  this.barChartLabelstransmission = this.date;
  this.barChartTypetransmission = 'bar';
  this.barChartLegendtransmission = true;
  this.barChartDatatransmission = [
   {data: this.transmission, label: 'Transmission',backgroundColor: "#FF4080"}
 ];
 }
 chartPerformance(){
  this.barChartLabelsperformance = this.date;
  this.barChartTypeperformance = 'bar';
  this.barChartLegendperformance = true;
  this.barChartDataperformance = [
   {data: this.performance, label: 'performance',backgroundColor: "#FF4080"}
 ];
  }

  initialisationchart(){
    this.barChartLabelsperseverance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
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
