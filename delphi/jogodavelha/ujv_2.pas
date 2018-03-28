unit ujv_2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls;

type
  TForm2 = class(TForm)
    Label1: TLabel;
    Label2: TLabel;
    Button1: TButton;
    Button2: TButton;
    procedure Button2Click(Sender: TObject);
    procedure Button1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form2: TForm2;

implementation

uses jogodavelha;

{$R *.dfm}

procedure TForm2.Button2Click(Sender: TObject);
begin
form1.close;
end;

procedure TForm2.Button1Click(Sender: TObject);
begin
form1.edit1.text:='';
form1.edit2.text:='';
form1.edit3.text:='';
form1.edit4.text:='';
form1.edit5.text:='';
form1.edit6.text:='';
form1.edit7.text:='';
form1.edit8.text:='';
form1.edit9.text:='';
form1.timer1.enabled:=true;
form2.Close;
end;

end.
