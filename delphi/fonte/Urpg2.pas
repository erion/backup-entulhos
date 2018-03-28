unit Urpg2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Gauges,urpg, ExtCtrls, ComCtrls;

type
  TForm2 = class(TForm)
    ComboBox2: TComboBox;
    ComboBox3: TComboBox;
    ComboBox4: TComboBox;
    ComboBox1: TComboBox;
    ComboBox5: TComboBox;
    ComboBox6: TComboBox;
    Label1: TLabel;
    Label2: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    Edit4: TEdit;
    Edit5: TEdit;
    Edit6: TEdit;
    Edit7: TEdit;
    Edit8: TEdit;
    Edit9: TEdit;
    Label11: TLabel;
    Edit10: TEdit;
    Edit11: TEdit;
    Label12: TLabel;
    Label13: TLabel;
    Edit12: TEdit;
    Button1: TButton;
    Button2: TButton;
    Button3: TButton;
    Timer1: TTimer;
    Timer2: TTimer;
    Label14: TLabel;
    Edit13: TEdit;
    Timer3: TTimer;
    Timer4: TTimer;
    Label16: TLabel;
    Label17: TLabel;
    Label18: TLabel;
    Label19: TLabel;
    GroupBox1: TGroupBox;
    Label3: TLabel;
    Label7: TLabel;
    ProgressBar1: TProgressBar;
    ProgressBar2: TProgressBar;
    Label15: TLabel;
    Label20: TLabel;
    Timer5: TTimer;
    Timer6: TTimer;
    procedure FormShow(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure Timer3Timer(Sender: TObject);
    procedure Timer4Timer(Sender: TObject);
    procedure Timer5Timer(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure Timer6Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form2: TForm2;
  inici,iniciativa,atq,atq2,a,b,c,d,e,f:integer;
  CA,CA2,armor,armor1,armor2,armor3,armor4,armor5,armor8:integer;
  dano,dano6,dano8,dano10,dano12:integer;
  inimigo1,inimigo2,inimigo3,inimigo4,inimigo5: array[1..5] of integer;
  inimigo,danoini:integer;
  xp,nivel,po,level:integer;

implementation
 
uses Unit4, Unit6;

{$R *.dfm}

procedure TForm2.FormShow(Sender: TObject);
begin
  {vida}
  progressbar1.Max:= 20 * cons;
  Progressbar1.Position:=20 * cons;
  {fim}
  label15.caption:= inttostr(progressbar1.max) + '/' + inttostr(progressbar1.position);
  label20.caption:= inttostr(progressbar2.max) + '/' + inttostr(progressbar2.position);
  label17.Caption:=inttostr(xp);
  label19.Caption:=inttostr(nivel);
  edit1.Text:=inttostr(forc);
  edit2.Text:=inttostr(dest);
  edit3.Text:=inttostr(cons);
  Randomize;
  inici:=random(20)+ StrToInt(edit5.text);
  form2.ComboBox1.ItemIndex:= form1.ComboBox1.ItemIndex;
  form2.ComboBox2.ItemIndex:= form1.ComboBox2.ItemIndex;
  form2.ComboBox3.ItemIndex:= form1.ComboBox3.ItemIndex;
  form2.ComboBox4.ItemIndex:= form1.ComboBox4.ItemIndex;
  case combobox1.ItemIndex of
  0:begin
          armor:=armor + armor1;
    end;
  1:begin
          armor:=armor + armor2;
    end;
  2:begin
          armor:=armor + armor3;
    end;
  3:begin
          armor:=armor + armor4;
    end;
  end;
  case combobox2.ItemIndex of
  0:begin
          dano := dano + dano8;
    end;
  1:begin
          dano := dano + dano10;
    end;
  2:begin
          dano := dano + dano6;
    end;
  3:begin
          dano := dano + dano8;
    end;
  4:begin
          dano := dano + dano12;
    end;
  5:begin
          dano := dano + dano8;
    end;
  6:begin
          dano := dano + dano10;
    end;
  end;
  case combobox3.ItemIndex of
  0:begin
          armor := armor + armor1;
    end;
  1:begin
          armor := armor + armor2;
    end;
  2:begin
          armor := armor + armor3;
    end;
  3:begin
          armor := armor + armor4;
    end;
  4:begin
          armor := armor + armor5;
    end;
  end;
  case combobox4.ItemIndex of
  0:begin
          armor:= armor + armor3;
    end;
  1:begin
          armor:= armor + armor4;
    end;
  2:begin
          armor:= armor + armor5;
    end;
  3:begin
          armor:= armor + armor8;
    end;
  end;

  CA:=strtoint(edit2.text) + 10;
  edit10.text:=inttostr(CA + armor);
  CA2:=strtoint(edit5.text) + 10;
  edit11.Text:=inttostr(CA2);
end;

procedure TForm2.Button3Click(Sender: TObject);
begin
  edit7.Text:=inttostr(iniciativa);
  button3.Enabled:=false;
  Randomize;
  iniciativa:=dest + random(20);
  edit8.Text:=inttostr(inici);
  inici:=strtoint(edit8.text);
  iniciativa:=strtoint(edit7.Text);
  if iniciativa > inici then
  button1.Enabled:=true;
  if inici > iniciativa then
  timer2.Enabled:=true;
  if inici = iniciativa then
  button3.Enabled:=true;
end;

procedure TForm2.Timer1Timer(Sender: TObject);
begin
  Randomize;
  iniciativa:=dest + random(20);
end;

procedure TForm2.Timer2Timer(Sender: TObject);
begin
  if progressbar2.position = 0 then
  begin
    button1.Enabled:=false;
    armor:=0;
    form2.Close;
    timer5.enabled:=true;
  end;

  if progressbar1.position = 0 then
  begin
    button1.Enabled:=false;
    armor:=0;
    showmessage('Você perdeu...SEU PODRE!!!!');
    form1.close;
    timer2.Enabled:=false;
  end;

  Randomize;
  atq:=random(20)+ strtoint(edit4.text);
  edit13.Text:=inttostr(atq);

  a:=strtoint(edit13.text);
  b:=strtoint(edit10.text);

  if a >= b then
  begin
    c:=strtoint(edit4.text)+ danoini;
    progressbar1.position:=progressbar1.position - c;
    edit9.text:=inttostr(c);
  end;

  timer2.enabled:=false;
  button1.Enabled:=true;
  case combobox1.ItemIndex of
  0:begin
          armor:=armor + armor1;
    end;
  1:begin
          armor:=armor + armor2;
    end;
  2:begin
          armor:=armor + armor3;
    end;
  3:begin
          armor:=armor + armor4;
    end;
  end;

  case combobox2.ItemIndex of
  0:begin
          dano := dano + dano8;
    end;
  1:begin
          dano := dano + dano10;
    end;
  2:begin
          dano := dano + dano6;
    end;
  3:begin
          dano := dano + dano8;
    end;
  4:begin
          dano := dano + dano12;
    end;
  5:begin
          dano := dano + dano8;
    end;
  6:begin
          dano := dano + dano10;
    end;
  end;

  case combobox3.ItemIndex of
  0:begin
          armor := armor + armor1;
    end;
  1:begin
          armor := armor + armor2;
    end;
  2:begin
          armor := armor + armor3;
    end;
  3:begin
          armor := armor + armor4;
    end;
  4:begin
          armor := armor + armor5;
    end;
  end;

  case combobox4.ItemIndex of
  0:begin
          armor:= armor + armor3;
    end;
  1:begin
          armor:= armor + armor4;
    end;
  2:begin
          armor:= armor + armor5;
    end;
  3:begin
          armor:= armor + armor8;
    end;
  end;
end;

procedure TForm2.Button2Click(Sender: TObject);
begin
  if e >= d then
  begin
    dano:= dano + strtoint(edit1.text);
    progressbar2.position:= progressbar2.position - dano;
    edit9.text:=inttostr(dano);
    label20.Caption:= inttostr(progressbar2.max) + '/' + inttostr(progressbar2.position);
  end;
  timer2.Enabled:=true;
  button2.Enabled:=false;
  dano:=0;
end;

procedure TForm2.FormCreate(Sender: TObject);
begin
  level:=1;
  nivel:=10;
  {0ponentes}
  {1 a 4 atributos,5 dinheiro}
  inimigo1[1]:=3;
  inimigo1[2]:=3;
  inimigo1[3]:=2;
  inimigo1[4]:=3;
  inimigo1[5]:=5;
  inimigo2[1]:=5;
  inimigo2[2]:=2;
  inimigo2[3]:=3;
  inimigo2[4]:=4;
  inimigo2[5]:=10;
  inimigo3[1]:=8;
  inimigo3[2]:=4;
  inimigo3[3]:=3;
  inimigo3[4]:=4;
  inimigo3[5]:=25;
  inimigo4[1]:=12;
  inimigo4[2]:=5;
  inimigo4[3]:=4;
  inimigo4[4]:=5;
  inimigo4[5]:=50;
  inimigo5[1]:=20;
  inimigo5[2]:=15;
  inimigo5[3]:=10;
  inimigo5[4]:=15;
  inimigo5[5]:=120;
  {fim}

  {valor de itens}
  armor1:=1;
  armor2:=2;
  armor3:=3;
  armor4:=4;
  armor5:=5;
  armor8:=8;
  {fim}
  {teste timer3}
  form2.ComboBox1.Items:= form1.ComboBox1.Items;
  form2.ComboBox2.Items:= form1.ComboBox2.Items;
  form2.ComboBox3.Items:= form1.ComboBox3.Items;
  form2.ComboBox4.Items:= form1.ComboBox4.Items;
end;

procedure TForm2.Button1Click(Sender: TObject);
begin
  Randomize;
  atq2:= strtoint(edit1.text) + random(20);
  d:=strtoint(edit11.text);
  e:=atq2;
  edit12.text:=inttostr(atq2);

  if e >= d then
  begin
    button2.Enabled:=true;
  end
  else
  begin
    timer2.Enabled:=true;
    dano:=0;
  end;
  
  button1.enabled:=false;
end;

procedure TForm2.Timer3Timer(Sender: TObject);
begin
  Randomize;
  dano6:=random(6);
  dano8:=random(8);
  dano10:=random(10);
  dano12:=random(12);
end;

procedure TForm2.Timer4Timer(Sender: TObject);
begin

if inimigo = 1 then
begin
  Progressbar2.Max:=20 * inimigo1[3];
  progressbar2.position:=20 * inimigo1[3];
  button3.Enabled:=true;
  edit4.Text:=inttostr(inimigo1[1]);
  edit5.text:=inttostr(inimigo1[2]);
  edit6.text:=inttostr(inimigo1[3]);
  edit11.Text:=inttostr(inimigo1[4] + inimigo1[2] + 10);
  danoini:= dano6;
  label20.Caption:=inttostr(progressbar2.max) + '/' + inttostr(progressbar2.position);
  timer4.Enabled:=false;
end;

if inimigo = 2 then
begin
  Progressbar2.Max:=20 * inimigo2[3];
  progressbar2.position:=20 * inimigo2[3];
  button3.Enabled:=true;
  edit4.Text:=inttostr(inimigo2[1]);
  edit5.text:=inttostr(inimigo2[2]);
  edit6.text:=inttostr(inimigo2[3]);
  edit11.Text:=inttostr(inimigo2[4] + inimigo2[2] + 10);
  danoini:= dano8;
  label20.Caption:=inttostr(progressbar2.max) + '/' + inttostr(progressbar2.position);
  timer4.Enabled:=false;
end;

if inimigo = 4 then
begin
  Progressbar2.Max:=20 * inimigo4[3];
  progressbar2.position:=20 * inimigo4[3];
  button3.Enabled:=true;
  edit4.Text:=inttostr(inimigo4[1]);
  edit5.text:=inttostr(inimigo4[2]);
  edit6.text:=inttostr(inimigo4[3]);
  edit11.Text:=inttostr(inimigo4[4] + inimigo4[2] + 10);
  danoini:= dano12;
  label20.Caption:=inttostr(progressbar2.max) + '/' + inttostr(progressbar2.position);
  timer4.Enabled:=false;
end;

{faltam os outros inimigos}
end;

procedure TForm2.Timer5Timer(Sender: TObject);
begin
  {teste xp}
  if inimigo = 1 then
  begin
    xp:= xp + 3;
    po:=po + inimigo1[5];
    form4.Label2.Caption:=inttostr(po);
    timer5.Enabled:= false;
  end;
  if inimigo = 2 then
  begin
    xp:= xp + 5;
    po:=po + inimigo2[5];
    form4.Label2.Caption:=inttostr(po);
    timer5.Enabled:= false;
  end;
  if inimigo = 4 then
  begin
    xp:= xp + 30;
    po:=po + inimigo5[5];
    form4.Label2.Caption:=inttostr(po);
    timer5.Enabled:= false;
  end;
  {fim}
  {aumenta level}
  if xp >= nivel then
  begin
    forc:=forc +1;
    dest:=dest +1;
    cons:=cons +1;
    nivel:=nivel *2;
    level:=level+1;
    label7.Caption:= inttostr(level);
    progressbar1.Max:= 20 * cons;
    showmessage('Você sububiu de nível...');
  end;
  {fim}
end;

procedure TForm2.FormClose(Sender: TObject; var Action: TCloseAction);
begin
  button1.Enabled:=false;
end;

procedure TForm2.Timer6Timer(Sender: TObject);
begin
  label15.Caption:=inttostr(progressbar1.max) + '/' + inttostr(progressbar1.position);
end;

end.
