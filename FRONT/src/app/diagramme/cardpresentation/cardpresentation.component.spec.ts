import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CardpresentationComponent } from './cardpresentation.component';

describe('CardpresentationComponent', () => {
  let component: CardpresentationComponent;
  let fixture: ComponentFixture<CardpresentationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CardpresentationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CardpresentationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
