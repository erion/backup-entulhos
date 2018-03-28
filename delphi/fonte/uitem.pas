unit uitem;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs,urpg2, StdCtrls, ExtCtrls;

type
  TForm5 = class(TForm)
    Label1: TLabel;
    Label2: TLabel;
    GroupBox1: TGroupBox;
    CheckBox1: TCheckBox;
    CheckBox2: TCheckBox;
    CheckBox3: TCheckBox;
    CheckBox4: TCheckBox;
    CheckBox5: TCheckBox;
    CheckBox6: TCheckBox;
    CheckBox7: TCheckBox;
    CheckBox8: TCheckBox;
    CheckBox9: TCheckBox;
    CheckBox10: TCheckBox;
    CheckBox11: TCheckBox;
    CheckBox12: TCheckBox;
    CheckBox13: TCheckBox;
    CheckBox14: TCheckBox;
    CheckBox15: TCheckBox;
    CheckBox16: TCheckBox;
    CheckBox17: TCheckBox;
    CheckBox18: TCheckBox;
    CheckBox19: TCheckBox;
    CheckBox20: TCheckBox;
    Edit1: TEdit;
    Label3: TLabel;
    Label4: TLabel;
    Edit2: TEdit;
    Button1: TButton;
    procedure FormCreate(Sender: TObject);
    procedure FormShow(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure CheckBox1Click(Sender: TObject);
    procedure CheckBox2Click(Sender: TObject);
    procedure CheckBox3Click(Sender: TObject);
    procedure CheckBox4Click(Sender: TObject);
    procedure CheckBox5Click(Sender: TObject);
    procedure CheckBox6Click(Sender: TObject);
    procedure CheckBox7Click(Sender: TObject);
    procedure CheckBox8Click(Sender: TObject);
    procedure CheckBox9Click(Sender: TObject);
    procedure CheckBox10Click(Sender: TObject);
    procedure CheckBox11Click(Sender: TObject);
    procedure CheckBox12Click(Sender: TObject);
    procedure CheckBox13Click(Sender: TObject);
    procedure CheckBox14Click(Sender: TObject);
    procedure CheckBox15Click(Sender: TObject);
    procedure CheckBox16Click(Sender: TObject);
    procedure CheckBox17Click(Sender: TObject);
    procedure CheckBox18Click(Sender: TObject);
    procedure CheckBox19Click(Sender: TObject);
    procedure CheckBox20Click(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form5: TForm5;
  preco: array[1..20] of integer;
  itcomp: array[1..20] of boolean;
  x,pogasto:integer;

implementation

{$R *.dfm}

procedure TForm5.FormCreate(Sender: TObject);
var
 i:integer;
begin
for i:=1 to 20 do
        begin
                itcomp[i]:=false;
        end;
for i:=1 to 10 do
        begin
                if i = 1 then
                preco[i]:=preco[i] + 10
                else
                preco[i]:=preco[i - 1 ] +10;
        end;
for i:=10 to 20 do
        begin
                preco[i]:=preco[i-1] + 100;
        end;
end;

procedure TForm5.FormShow(Sender: TObject);
begin
label2.Caption:=inttostr(po);
edit2.Text:=inttostr(po);
end;

procedure TForm5.Button1Click(Sender: TObject);
begin
if po = 0 then
        begin
        showmessage('Você não tem dinheiro!');
        end
else
if po >= x then
        begin
        showmessage('Volte sempre!');
        po:= po - pogasto;
        po:=strtoint(edit2.text);
        label2.Caption:=inttostr(po);
        if strtoint(edit2.text) < 0 then
                begin
                showmessage('Você não pode ficar devendo');
                end
        else
                begin
                if CheckBox1.Checked then
                        begin
                        pogasto := pogasto + preco[1];
                        itcomp[1]:=true;
                        end;
                if CheckBox2.Checked then
                        begin
                        pogasto := pogasto + preco[2];
                        itcomp[2]:=true;
                        end;
                if CheckBox3.Checked then
                        begin
                        pogasto := pogasto + preco[3];
                        itcomp[3]:=true;
                        end;
                if CheckBox4.Checked then
                        begin
                        pogasto := pogasto + preco[4];
                        itcomp[4]:=true;
                        end;
                if CheckBox5.Checked then
                        begin
                        pogasto := pogasto + preco[5];
                        itcomp[5]:=true;
                        end;
                if CheckBox6.Checked then
                        begin
                        pogasto := pogasto + preco[6];
                        itcomp[6]:=true;
                        end;
                if CheckBox7.Checked then
                        begin
                        pogasto := pogasto + preco[7];
                        itcomp[7]:=true;
                        end;
                if CheckBox8.Checked then
                        begin
                        pogasto := pogasto + preco[8];
                        itcomp[8]:=true;
                        end;
                if CheckBox9.Checked then
                        begin
                        pogasto := pogasto + preco[9];
                        itcomp[9]:=true;
                        end;
                if CheckBox10.Checked then
                        begin
                        pogasto := pogasto + preco[10];
                        itcomp[10]:=true;
                        end;
                if CheckBox11.Checked then
                        begin
                        pogasto := pogasto + preco[11];
                        itcomp[11]:=true;
                        end;
                if CheckBox12.Checked then
                        begin
                        pogasto := pogasto + preco[12];
                        itcomp[12]:=true;
                        end;
                if CheckBox13.Checked then
                        begin
                        pogasto := pogasto + preco[13];
                        itcomp[13]:=true;
                        end;
                if CheckBox14.Checked then
                        begin
                        pogasto := pogasto + preco[14];
                        itcomp[14]:=true;
                        end;
                if CheckBox15.Checked then
                        begin
                        pogasto := pogasto + preco[15];
                        itcomp[15]:=true;
                        end;
                if CheckBox16.Checked then
                        begin
                        pogasto := pogasto + preco[16];
                        itcomp[16]:=true;
                        end;
                if CheckBox17.Checked then
                        begin
                        pogasto := pogasto + preco[17];
                        itcomp[17]:=true;
                        end;
                if CheckBox18.Checked then
                        begin
                        pogasto := pogasto + preco[18];
                        itcomp[18]:=true;
                        end;
                if CheckBox19.Checked then
                        begin
                        pogasto := pogasto + preco[19];
                        itcomp[19]:=true;
                        end;
                if CheckBox20.Checked then
                        begin
                        pogasto := pogasto + preco[20];
                        itcomp[20]:=true;
                        end;
                edit1.Text:=inttostr(pogasto);
                edit2.text:=inttostr(po - pogasto);
                end;
                end
else
       begin
       showmessage('Você não pode ficar devendo, compre menos itens!');
       end;
end;

procedure TForm5.CheckBox1Click(Sender: TObject);
begin
if checkbox1.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[1]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[1]);
        x:=x + preco[1];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[1]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[1]);
        x:=x - preco[1];
        end;
end;

procedure TForm5.CheckBox2Click(Sender: TObject);
begin
if checkbox2.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[2]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[2]);
        x:=x + preco[2];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[2]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[2]);
        x:=x - preco[2];
        end;
end;

procedure TForm5.CheckBox3Click(Sender: TObject);
begin
if checkbox3.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[3]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[3]);
        x:=x + preco[3];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[3]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[3]);
        x:=x - preco[3];
        end;
end;

procedure TForm5.CheckBox4Click(Sender: TObject);
begin
if checkbox4.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[4]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[4]);
        x:=x + preco[4];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[4]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[4]);
        x:=x - preco[4];
        end;
end;

procedure TForm5.CheckBox5Click(Sender: TObject);
begin
if checkbox5.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[5]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[5]);
        x:=x + preco[5];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[5]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[5]);
        x:=x - preco[5];
        end;
end;

procedure TForm5.CheckBox6Click(Sender: TObject);
begin
if checkbox6.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[6]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[6]);
        x:=x + preco[6];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[6]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[6]);
        x:=x - preco[6];
        end;
end;

procedure TForm5.CheckBox7Click(Sender: TObject);
begin
if checkbox7.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[7]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[7]);
        x:=x + preco[7];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[7]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[7]);
        x:=x - preco[7];
        end;
end;

procedure TForm5.CheckBox8Click(Sender: TObject);
begin
if checkbox8.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[8]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[8]);
        x:=x + preco[8];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[8]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[8]);
        x:=x - preco[8];
        end;
end;

procedure TForm5.CheckBox9Click(Sender: TObject);
begin
if checkbox9.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[9]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[9]);
        x:=x + preco[9];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[9]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[9]);
        x:=x - preco[9];
        end;
end;

procedure TForm5.CheckBox10Click(Sender: TObject);
begin
if checkbox10.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[10]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[10]);
        x:=x + preco[10];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[10]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[10]);
        x:=x - preco[10];
        end;
end;

procedure TForm5.CheckBox11Click(Sender: TObject);
begin
if checkbox11.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[11]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[11]);
        x:=x + preco[11];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[11]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[11]);
        x:=x - preco[11];
        end;
end;

procedure TForm5.CheckBox12Click(Sender: TObject);
begin
if checkbox12.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[12]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[12]);
        x:=x + preco[12];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[12]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[12]);
        x:=x - preco[12];
        end;
end;

procedure TForm5.CheckBox13Click(Sender: TObject);
begin
if checkbox13.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[13]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[13]);
        x:=x + preco[13];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[13]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[13]);
        x:=x - preco[13];
        end;
end;

procedure TForm5.CheckBox14Click(Sender: TObject);
begin
if checkbox14.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[14]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[14]);
        x:=x + preco[14];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[14]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[14]);
        x:=x - preco[14];
        end;
end;

procedure TForm5.CheckBox15Click(Sender: TObject);
begin
if checkbox15.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[15]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[15]);
        x:=x + preco[15];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[15]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[15]);
        x:=x - preco[15];
        end;
end;

procedure TForm5.CheckBox16Click(Sender: TObject);
begin
if checkbox16.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[16]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[16]);
        x:=x + preco[16];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[16]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[16]);
        x:=x - preco[16];
        end;
end;

procedure TForm5.CheckBox17Click(Sender: TObject);
begin
if checkbox17.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[17]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[17]);
        x:=x + preco[17];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[17]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[17]);
        x:=x - preco[17];
        end;
end;

procedure TForm5.CheckBox18Click(Sender: TObject);
begin
if checkbox18.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[18]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[18]);
        x:=x + preco[18];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[18]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[18]);
        x:=x - preco[18];
        end;
end;

procedure TForm5.CheckBox19Click(Sender: TObject);
begin
if checkbox19.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[19]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[19]);
        x:=x + preco[19];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[19]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[19]);
        x:=x - preco[19];
        end;
end;

procedure TForm5.CheckBox20Click(Sender: TObject);
begin
if checkbox20.Checked then
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) + preco[20]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) - preco[20]);
        x:=x + preco[20];
        end
else
        begin
        edit1.text:=inttostr(strtointdef(edit1.Text,0) - preco[20]);
        edit2.text:=inttostr(strtointdef(edit2.text,0) + preco[20]);
        x:=x - preco[20];
        end;
end;

procedure TForm5.FormClose(Sender: TObject; var Action: TCloseAction);
begin
edit1.text:='0';
checkbox1.Checked:=false;
checkbox2.Checked:=false;
checkbox3.Checked:=false;
checkbox4.Checked:=false;
checkbox5.Checked:=false;
checkbox6.Checked:=false;
checkbox7.Checked:=false;
checkbox8.Checked:=false;
checkbox9.Checked:=false;
checkbox10.Checked:=false;
checkbox11.Checked:=false;
checkbox12.Checked:=false;
checkbox13.Checked:=false;
checkbox14.Checked:=false;
checkbox15.Checked:=false;
checkbox16.Checked:=false;
checkbox17.Checked:=false;
checkbox18.Checked:=false;
checkbox19.Checked:=false;
checkbox20.Checked:=false;
end;

end.
