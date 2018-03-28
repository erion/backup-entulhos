unit utabu1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ExtCtrls, Menus;

type
  TForm1 = class(TForm)
    Button1: TButton;
    CheckBox1: TCheckBox;
    CheckBox2: TCheckBox;
    CheckBox3: TCheckBox;
    CheckBox4: TCheckBox;
    Image1: TImage;
    Image2: TImage;
    Image3: TImage;
    Image4: TImage;
    Image5: TImage;
    Image6: TImage;
    Image7: TImage;
    Image8: TImage;
    Label1: TLabel;
    Label2: TLabel;
    Label4: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit4: TEdit;
    Button2: TButton;
    Button3: TButton;
    Button4: TButton;
    Button5: TButton;
    Button8: TButton;
    Button9: TButton;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Label10: TLabel;
    Edit5: TEdit;
    Edit6: TEdit;
    Edit8: TEdit;
    Button10: TButton;
    Button11: TButton;
    Button12: TButton;
    Button13: TButton;
    Button16: TButton;
    Button17: TButton;
    Label11: TLabel;
    Label12: TLabel;
    Label13: TLabel;
    Label14: TLabel;
    Label16: TLabel;
    Edit9: TEdit;
    Edit10: TEdit;
    Edit12: TEdit;
    Button18: TButton;
    Button19: TButton;
    Button20: TButton;
    Button21: TButton;
    Button24: TButton;
    Button25: TButton;
    Label17: TLabel;
    Label18: TLabel;
    Label19: TLabel;
    Label20: TLabel;
    Label22: TLabel;
    Edit13: TEdit;
    Edit14: TEdit;
    Edit16: TEdit;
    Button26: TButton;
    Button27: TButton;
    Button28: TButton;
    Button29: TButton;
    Button32: TButton;
    Button33: TButton;
    Label23: TLabel;
    Label24: TLabel;
    Button34: TButton;
    Button35: TButton;
    Button36: TButton;
    Button37: TButton;
    MainMenu1: TMainMenu;
    Informaes1: TMenuItem;
    Image9: TImage;
    Image10: TImage;
    Image11: TImage;
    Image12: TImage;
    procedure Button1Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure Button4Click(Sender: TObject);
    procedure Button8Click(Sender: TObject);
    procedure Button10Click(Sender: TObject);
    procedure Button12Click(Sender: TObject);
    procedure Button16Click(Sender: TObject);
    procedure Button18Click(Sender: TObject);
    procedure Button20Click(Sender: TObject);
    procedure Button24Click(Sender: TObject);
    procedure Button26Click(Sender: TObject);
    procedure Button28Click(Sender: TObject);
    procedure Button32Click(Sender: TObject);
    procedure Button5Click(Sender: TObject);
    procedure Button9Click(Sender: TObject);
    procedure Button11Click(Sender: TObject);
    procedure Button13Click(Sender: TObject);
    procedure Button17Click(Sender: TObject);
    procedure Button19Click(Sender: TObject);
    procedure Button21Click(Sender: TObject);
    procedure Button25Click(Sender: TObject);
    procedure Button27Click(Sender: TObject);
    procedure Button29Click(Sender: TObject);
    procedure Button33Click(Sender: TObject);
    procedure Button34Click(Sender: TObject);
    procedure Button35Click(Sender: TObject);
    procedure Button36Click(Sender: TObject);
    procedure Button37Click(Sender: TObject);
    procedure Informaes1Click(Sender: TObject);
    procedure CheckBox1Click(Sender: TObject);
    procedure CheckBox2Click(Sender: TObject);
    procedure CheckBox3Click(Sender: TObject);
    procedure CheckBox4Click(Sender: TObject);
    procedure Image2Click(Sender: TObject);
    procedure Image1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  cont:integer;{contador para troca de imagens na seleção
                de personagens}
  atributos:array[1..4,1..3] of integer; {atributos dos
                                 personagens,4linhas p/
                                    4jogadores,3colunas
                                         p/3atrtibutos}

implementation

uses utabu2, uinfo;

{$R *.dfm}

{************************************************************
*************** Minhas procedures e functions ***************
************************************************************}

//incrementa 1 nos edits
procedure incrementa(edit:tedit;lab:tlabel);
var
a,b:integer;
begin
b:= strtoint(lab.Caption);
  if b > 0 then
    begin
      b:= strtoint(lab.Caption) - 1;
      lab.Caption:= inttostr(b);
      a:= strtoint(edit.Text) + 1;
      edit.Text:= inttostr(a);
    end
  else
    begin
      showmessage('Pontos esgotados!');
    end;
end;

//decrementa 1 nos edits
procedure decrementa(edit:tedit;lab:tlabel);
var
a,b:integer;
begin
b:= strtoint(lab.Caption);
  if strtoint(edit.text) = 0 then
    begin
      showmessage('Valor não pode ser menor que zero!')
    end
  else
    begin
      b:= b + 1;
      a:= strtoint(edit.Text) - 1;
      edit.Text:= inttostr(a);
    end;
lab.Caption:= inttostr(b);
end;

//desativa botoes de atributos
procedure desativa(a,b,c,d,e,f:tbutton);
begin
a.Enabled:=false;
b.Enabled:=false;
c.Enabled:=false;
d.Enabled:=false;
e.Enabled:=false;
f.Enabled:=false;
end;

//quando o jogador é selecionado aparecem as opções
procedure inicia_jogador(a,b:timage;c,d,e,f,g:tlabel;h,i,j:tedit;
l,m,n,o,p,q:tbutton;r:tcheckbox);
begin
if r.Checked = true then
  begin
    a.Visible:= true;
    b.Visible:= true;
    c.Visible:= true;
    d.Visible:= true;
    e.Visible:= true;
    f.Visible:= true;
    g.Visible:= true;
    h.Visible:= true;
    i.Visible:= true;
    j.Visible:= true;
    l.Visible:= true;
    m.Visible:= true;
    n.Visible:= true;
    o.Visible:= true;
    p.Visible:= true;
    q.Visible:= true;
  end
else
  begin
    a.Visible:= false;
    b.Visible:= false;
    c.Visible:= false;
    d.Visible:= false;
    e.Visible:= false;
    f.Visible:= false;
    g.Visible:= false;
    h.Visible:= false;
    i.Visible:= false;
    j.Visible:= false;
    l.Visible:= false;
    m.Visible:= false;
    n.Visible:= false;
    o.Visible:= false;
    p.Visible:= false;
    q.Visible:= false;
  end;
end;

//seleciona c/botao da direita
procedure seleciona_personagem_d(image:timage);
begin
cont:= cont + 1;
case cont of
1:begin
    image.Picture.LoadFromFile('barbaro.bmp');
  end;
2:begin
    image.Picture.LoadFromFile('ladrao.bmp');
  end;
3:begin
    image.Picture.LoadFromFile('ranger.bmp');
  end;
4:begin
    image.Picture.LoadFromFile('tamanho_boneco.bmp');
  end;
end;
if cont = 4 then
  begin
    cont := 0;
  end;
end;

//seleciona c/botao da esquerda
procedure seleciona_personagem_e(image:timage);
begin
cont:=cont - 2;
if cont = -1 then
  begin
    cont:=0;
  end;
if cont = -2 then
  begin
    cont:=3;
  end;
seleciona_personagem_d(image);
end;

{************************************************************
*************** Fim das procedures e functions **************
************************************************************}

procedure TForm1.Button1Click(Sender: TObject);
begin
form2.show;
end;

procedure TForm1.Button2Click(Sender: TObject);
begin
incrementa(edit1,label5);
end;

procedure TForm1.Button3Click(Sender: TObject);
begin
decrementa(edit1,label5);
end;

procedure TForm1.Button4Click(Sender: TObject);
begin
incrementa(edit2,label5);
end;

procedure TForm1.Button8Click(Sender: TObject);
begin
incrementa(edit4,label5);
end;

procedure TForm1.Button10Click(Sender: TObject);
begin
incrementa(edit5,label11);
end;

procedure TForm1.Button12Click(Sender: TObject);
begin
incrementa(edit6,label11);
end;

procedure TForm1.Button16Click(Sender: TObject);
begin
incrementa(edit8,label11);
end;

procedure TForm1.Button18Click(Sender: TObject);
begin
incrementa(edit9,label17);
end;

procedure TForm1.Button20Click(Sender: TObject);
begin
incrementa(edit10,label17);
end;

procedure TForm1.Button24Click(Sender: TObject);
begin
incrementa(edit12,label17);
end;

procedure TForm1.Button26Click(Sender: TObject);
begin
incrementa(edit13,label23);
end;

procedure TForm1.Button28Click(Sender: TObject);
begin
incrementa(edit14,label23);
end;

procedure TForm1.Button32Click(Sender: TObject);
begin
incrementa(edit16,label23);
end;

procedure TForm1.Button5Click(Sender: TObject);
begin
decrementa(edit2,label5);
end;

procedure TForm1.Button9Click(Sender: TObject);
begin
decrementa(edit4,label5);
end;

procedure TForm1.Button11Click(Sender: TObject);
begin
decrementa(edit5,label11);
end;

procedure TForm1.Button13Click(Sender: TObject);
begin
decrementa(edit6,label11);
end;

procedure TForm1.Button17Click(Sender: TObject);
begin
decrementa(edit8,label11);
end;

procedure TForm1.Button19Click(Sender: TObject);
begin
decrementa(edit9,label17);
end;

procedure TForm1.Button21Click(Sender: TObject);
begin
decrementa(edit10,label17);
end;

procedure TForm1.Button25Click(Sender: TObject);
begin
decrementa(edit12,label17);
end;

procedure TForm1.Button27Click(Sender: TObject);
begin
decrementa(edit13,label23);
end;

procedure TForm1.Button29Click(Sender: TObject);
begin
decrementa(edit14,label23);
end;

procedure TForm1.Button33Click(Sender: TObject);
begin
decrementa(edit16,label23);
end;

procedure TForm1.Button34Click(Sender: TObject);
begin
desativa(button2,button3,button4,button5,button8,button9);
form2.image6.Picture:= form1.image9.Picture;
atributos[1,1]:= strtoint(edit1.text);
atributos[1,2]:= strtoint(edit2.text);
atributos[1,3]:= strtoint(edit4.text);
end;

procedure TForm1.Button35Click(Sender: TObject);
begin
desativa(button10,button11,button12,button13,button16,button17);
form2.image7.Picture:= form1.image10.Picture;
atributos[2,1]:= strtoint(edit5.text);
atributos[2,2]:= strtoint(edit6.text);
atributos[2,3]:= strtoint(edit8.text);
end;

procedure TForm1.Button36Click(Sender: TObject);
begin
desativa(button18,button19,button20,button21,button24,button25);
form2.image8.Picture:= form1.image11.Picture;
atributos[3,1]:= strtoint(edit9.text);
atributos[3,2]:= strtoint(edit10.text);
atributos[3,3]:= strtoint(edit12.text);
end;

procedure TForm1.Button37Click(Sender: TObject);
begin
desativa(button26,button27,button28,button29,button32,button33);
form2.image9.Picture:= form1.image12.Picture;
atributos[4,1]:= strtoint(edit13.text);
atributos[4,2]:= strtoint(edit14.text);
atributos[4,3]:= strtoint(edit16.text);
end;

procedure TForm1.Informaes1Click(Sender: TObject);
begin
form3.showmodal;
end;

procedure TForm1.CheckBox1Click(Sender: TObject);
begin
inicia_jogador(image1,image2,label1,label2,label4,label5,label6,edit1,
edit2,edit4,button2,button3,button4,button5,button8,button9,checkbox1);
form2.Image6.Visible:=true;
end;

procedure TForm1.CheckBox2Click(Sender: TObject);
begin
inicia_jogador(image3,image4,label7,label8,label10,label11,label12,edit5,
edit6,edit8,button10,button11,button12,button13,button16,button17,checkbox2);
form2.Image7.Visible:=true;
end;

procedure TForm1.CheckBox3Click(Sender: TObject);
begin
inicia_jogador(image5,image6,label13,label14,label16,label17,label18,edit9,
edit10,edit12,button18,button19,button20,button21,button24,button25,checkbox3);
form2.Image8.Visible:=true;
end;

procedure TForm1.CheckBox4Click(Sender: TObject);
begin
inicia_jogador(image7,image8,label19,label20,label22,label23,label24,edit13,
edit14,edit16,button26,button27,button28,button29,button32,button33,checkbox4);
form2.Image9.Visible:=true;
end;

procedure TForm1.Image2Click(Sender: TObject);
begin
seleciona_personagem_d(image9);
end;

procedure TForm1.Image1Click(Sender: TObject);
begin
seleciona_personagem_e(image9);
end;

end.
