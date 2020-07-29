import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TestsummerComponent } from './testsummer.component';

describe('TestsummerComponent', () => {
  let component: TestsummerComponent;
  let fixture: ComponentFixture<TestsummerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TestsummerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TestsummerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
