import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AnneComponent } from './anne.component';

describe('AnneComponent', () => {
  let component: AnneComponent;
  let fixture: ComponentFixture<AnneComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AnneComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AnneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
