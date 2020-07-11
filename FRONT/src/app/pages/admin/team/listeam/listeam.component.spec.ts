import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListeamComponent } from './listeam.component';

describe('ListeamComponent', () => {
  let component: ListeamComponent;
  let fixture: ComponentFixture<ListeamComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListeamComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListeamComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
