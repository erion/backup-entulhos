unit Urpg;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ExtCtrls, Menus;

type
  TForm1 = class(TForm)
    MainMenu1: TMainMenu;
    Jogo1: TMenuItem;
    RolarValores1: TMenuItem;
    Iniciar1: TMenuItem;
    Sair1: TMenuItem;
    Ajuda1: TMenuItem;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    Button1: TButton;
    Button2: TButton;
    Button3: TButton;
    RadioGroup1: TRadioGroup;
    Label4: TLabel;
    ComboBox1: TComboBox;
    ComboBox2: TComboBox;
    ComboBox3: TComboBox;
    ComboBox4: TComboBox;
    Button4: TButton;
    Timer1: TTimer;
    Timer2: TTimer;
    Timer3: TTimer;
    Label5: TLabel;
    procedure RolarValores1Click(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure RadioGroup1Click(Sender: TObject);
    procedure Iniciar1Click(Sender: TObject);
    procedure Button4Click(Sender: TObject);
    procedure Ajuda1Click(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Sair1Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
    procedure Timer3Timer(Sender: TObject);
    procedure ComboBox1Change(Sender: TObject);
    procedure ComboBox3Change(Sender: TObject);
    procedure ComboBox4Change(Sender: TObject);
    procedure ComboBox2Change(Sender: TObject);

  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  forc,dest,cons:integer;

implementation

uses Urpg2, Urpg3ajuda, Unit4;

{$R *.dfm}

procedure TForm1.RolarValores1Click(Sender: TObject);
begin
  button1.Enabled:=true;
  button2.Enabled:=true;
  button3.Enabled:=true;
end;

procedure TForm1.Button3Click(Sender: TObject);
begin
  radiogroup1.Enabled:=true;
  button3.Enabled:=false;
  edit3.Text:=inttostr(cons);
  timer3.enabled:=false;
end;

procedure TForm1.RadioGroup1Click(Sender: TObject);
begin
  combobox1.Enabled:=true;
  combobox2.Enabled:=true;
  combobox3.Enabled:=true;
  combobox4.Enabled:=true;
  button4.Enabled:=true;
end;

procedure TForm1.Iniciar1Click(Sender: TObject);
begin
  form4.showmodal;
end;

procedure TForm1.Button4Click(Sender: TObject);
begin
  iniciar1.Enabled:=true;
  button4.Visible:=false;
  label5.Visible:=true;
  combobox1.Enabled:=false;
  combobox2.Enabled:=false;
  combobox3.Enabled:=false;
  combobox4.Enabled:=false;
end;

procedure TForm1.Ajuda1Click(Sender: TObject);
begin
  form3.showmodal;
end;

procedure TForm1.Button1Click(Sender: TObject);
begin
  button1.Enabled:=false;
  edit1.Text:=inttostr(forc);
  timer1.enabled:=false;
end;

procedure TForm1.Button2Click(Sender: TObject);
begin
  button2.Enabled:=false;
  edit2.Text:=inttostr(dest);
  timer2.enabled:=false;
end;

procedure TForm1.Sair1Click(Sender: TObject);
begin
  form1.Close;
end;

procedure TForm1.Timer1Timer(Sender: TObject);
begin
  Randomize;
  forc:=random(5)+1;
end;

procedure TForm1.Timer2Timer(Sender: TObject);
begin
  Randomize;
  dest:=random(5)+1;
end;

procedure TForm1.Timer3Timer(Sender: TObject);
begin
  Randomize;
  cons:=random(5)+1;
end;

procedure TForm1.ComboBox1Change(Sender: TObject);
begin
  case combobox1.ItemIndex of
  0:begin
    end;
  1:begin
          showmessage('Item indisponível no momento!');
          combobox1.ItemIndex:= -1;
    end;
  2:begin
          showmessage('Item indisponível no momento!');
          combobox1.ItemIndex:= -1;
    end;
  3:begin
          showmessage('Item indisponível no momento!');
          combobox1.ItemIndex:= -1;
    end;
  end;
end;

procedure TForm1.ComboBox3Change(Sender: TObject);
begin
  case combobox3.ItemIndex of
  0:begin
    end;
  1:begin
          showmessage('Item indisponível no momento!');
          combobox3.ItemIndex:= -1;
    end;
  2:begin
          showmessage('Item indisponível no momento!');
          combobox3.ItemIndex:= -1;
    end;
  3:begin
          showmessage('Item indisponível no momento!');
          combobox3.ItemIndex:= -1;
    end;
  4:begin
          showmessage('Item indisponível no momento!');
          combobox3.ItemIndex:= -1;
    end;
  end;
end;

procedure TForm1.ComboBox4Change(Sender: TObject);
begin
  case combobox4.ItemIndex of
  0:begin
    end;
  1:begin
          showmessage('Item indisponível no momento!');
          combobox4.ItemIndex:= -1;
    end;
  2:begin
          showmessage('Item indisponível no momento!');
          combobox4.ItemIndex:= -1;
    end;
  3:begin
          showmessage('Item indisponível no momento!');
          combobox4.ItemIndex:= -1;
    end;
  end;
end;

procedure TForm1.ComboBox2Change(Sender: TObject);
begin
  case combobox2.ItemIndex of
  0:begin
          if radiogroup1.ItemIndex = 1 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
          if radiogroup1.ItemIndex = 3 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  1:begin
          if radiogroup1.ItemIndex = 2 then
          else
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  2:begin
          if radiogroup1.ItemIndex = 3 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
          if radiogroup1.ItemIndex = 0 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  3:begin
          if radiogroup1.ItemIndex = 1 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
          if radiogroup1.ItemIndex = 2 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  4:begin
          if radiogroup1.ItemIndex = 1 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
          if radiogroup1.ItemIndex = 2 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  5:begin
    end;
  6:begin
          if radiogroup1.ItemIndex = 1 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
          if radiogroup1.ItemIndex = 3 then
                  begin
                          showmessage('Item indisponível no momento!');
                          combobox2.ItemIndex:= -1;
                  end;
    end;
  end;
end;

end.
