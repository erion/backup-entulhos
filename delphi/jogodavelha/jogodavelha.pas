unit jogodavelha;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Menus, ExtCtrls;

type
  TForm1 = class(TForm)
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    Edit4: TEdit;
    Edit5: TEdit;
    Edit6: TEdit;
    Edit7: TEdit;
    Edit8: TEdit;
    Edit9: TEdit;
    Edit10: TEdit;
    Edit11: TEdit;
    Timer1: TTimer;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Memo1: TMemo;
    procedure Edit1Click(Sender: TObject);
    procedure Edit2Click(Sender: TObject);
    procedure Edit4Click(Sender: TObject);
    procedure Edit5Click(Sender: TObject);
    procedure Edit6Click(Sender: TObject);
    procedure Edit7Click(Sender: TObject);
    procedure Edit8Click(Sender: TObject);
    procedure Edit9Click(Sender: TObject);
    procedure Edit3Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure FormShow(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  vez:boolean;
  tab:array [1..3,1..3] of integer;
  plac:array[1..3] of integer;

implementation

uses ujv_2;

procedure testa_vitoria();
var
i,j,cont:integer;
begin
for i:=1 to 3 do
  begin
    for j:=1 to 3 do
      begin
        if  ((tab[i,1]         {se bolinha}
        and tab[i,2]
        and tab[i,3])
        or (tab[1,j]
        and tab[2,j]
        and tab[3,j])
        or (tab[1,1]
        and tab[2,2]
        and tab[3,3])
        or (tab[3,1]
        and tab[2,2]
        and tab[1,3]))= 1 then
          begin
            cont:=0;
            plac[3]:=1;
            form2.Label1.Caption :=form1.edit10.text + ' venceu!';
            form2.showmodal;
          end
        else
          begin                {se não é xis e faz isso}
            if  ((tab[i,1]
            and tab[i,2]
            and tab[i,3])
            or (tab[1,j]
            and tab[2,j]
            and tab[3,j])
            or (tab[1,1]
            and tab[2,2]
            and tab[3,3])
            or (tab[3,1]
            and tab[2,2]
            and tab[1,3]))= 2 then
              begin
                cont:=0;
                plac[3]:=2;
                form2.Label1.Caption :=form1.edit11.text+ ' venceu!';
                form2.showmodal;
              end;
          end;
        if tab[i,j] <> 0 then  {teste para velha}
          begin

            cont:=cont +1;
          end;
      end;
  end;
if cont = 9 then
  begin
    form2.Show;
    form2.Label1.Caption:='Velha!!!!!!';
  end;
if plac[3] = 1 then
  begin
    plac[1]:=plac[1] + 1;
    plac[3]:=0;
    form1.Label3.caption:= inttostr(plac[1]);
  end;
if plac[3] = 2 then
  begin
    plac[2]:=plac[2] + 1;
    plac[3]:=0;
    form1.Label5.caption:= inttostr(plac[2]);
  end;

end;

{$R *.dfm}

procedure TForm1.Edit1Click(Sender: TObject);
begin
if edit1.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit1.Text:=' O';
        vez:=false;
        tab[1,1]:=1;
        testa_vitoria;
        end
else
        begin
        edit1.text:=' X';
        vez:=true;
        tab[1,1]:=2;
        testa_vitoria;
        end;
end;

procedure TForm1.Edit2Click(Sender: TObject);
begin
if edit2.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit2.Text:=' O';
        vez:=false;
        tab[1,2]:=1;
        testa_vitoria;
        end
else
        begin
        edit2.text:=' X';
        vez:=true;
        tab[1,2]:=2;
        testa_vitoria;
        end;
end;

procedure TForm1.Edit4Click(Sender: TObject);
begin
if edit4.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit4.Text:=' O';
        vez:=false;
        tab[2,1]:=1;
        testa_vitoria;
        end
else
        begin
        edit4.text:=' X';
        vez:=true;
        tab[2,1]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Edit5Click(Sender: TObject);
begin
if edit5.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit5.Text:=' O';
        vez:=false;
        tab[2,2]:=1;
        testa_vitoria;
        end
else
        begin
        edit5.text:=' X';
        vez:=true;
        tab[2,2]:=2;
        testa_vitoria;
        end;
end;

procedure TForm1.Edit6Click(Sender: TObject);
begin
if edit6.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit6.Text:=' O';
        vez:=false;
        tab[2,3]:=1;
        testa_vitoria;
        end
else
        begin
        edit6.text:=' X';
        vez:=true;
        tab[2,3]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Edit7Click(Sender: TObject);
begin
if edit7.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit7.Text:=' O';
        vez:=false;
        tab[3,1]:= 1;
        testa_vitoria;
        end
else
        begin
        edit7.text:=' X';
        vez:=true;
        tab[3,1]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Edit8Click(Sender: TObject);
begin
if edit8.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit8.Text:=' O';
        vez:=false;
        tab[3,2]:=1;
        testa_vitoria;
        end
else
        begin
        edit8.text:=' X';
        vez:=true;
        tab[3,2]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Edit9Click(Sender: TObject);
begin
if edit9.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit9.Text:=' O';
        vez:=false;
        tab[3,3]:=1;
        testa_vitoria;
        end
else
        begin
        edit9.text:=' X';
        vez:=true;
        tab[3,3]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Edit3Click(Sender: TObject);
begin
if edit3.Text <> '' then
        begin
        showmessage('Não é possível jogar aí denovo!');
        end
else
if vez = true then
        begin
        edit3.Text:=' O';
        vez:=false;
        tab[1,3]:=1;
        testa_vitoria;
        end
else
        begin
        edit3.text:=' X';
        vez:=true;
        tab[1,3]:=2;
        testa_vitoria;
        end;

end;

procedure TForm1.Timer1Timer(Sender: TObject);
var
i,j:integer;
begin
for i:=1 to 3 do
  begin
    for j:=1 to 3 do
      begin
      tab[i,j]:= 0;
      end;
  end;
timer1.enabled:=false;
end;

procedure TForm1.FormShow(Sender: TObject);
begin
label3.caption:= inttostr(plac[2]);
label5.caption:= inttostr(plac[1]);
end;

end.
