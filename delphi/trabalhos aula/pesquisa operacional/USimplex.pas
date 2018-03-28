unit USimplex;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ExtCtrls, ComCtrls;

type
  TfrmSimplex = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Button1: TButton;
    variavelX4: TEdit;
    variavelX3: TEdit;
    variavelX2: TEdit;
    variavelX1: TEdit;
    Label2: TLabel;
    restricao1: TEdit;
    restricao5: TEdit;
    restricao9: TEdit;
    restricao13: TEdit;
    ComboBox1: TComboBox;
    total1: TEdit;
    total2: TEdit;
    total3: TEdit;
    total4: TEdit;
    ComboBox4: TComboBox;
    ComboBox3: TComboBox;
    ComboBox2: TComboBox;
    restricao10: TEdit;
    restricao14: TEdit;
    restricao15: TEdit;
    restricao16: TEdit;
    restricao12: TEdit;
    restricao11: TEdit;
    restricao6: TEdit;
    restricao7: TEdit;
    restricao8: TEdit;
    restricao4: TEdit;
    restricao3: TEdit;
    restricao2: TEdit;
    Label3: TLabel;
    Button2: TButton;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Button3: TButton;
    procedure FormShow(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Button3Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmSimplex: TfrmSimplex;
  qtdVariavel, qtdRestricao: integer; // qtds adicionadas
  simplex: array [1..50,1..50] of Double; // valores do simplex
  EdtVar: array [1..50] of string;  // nomes para variaveis criadas
  EdtRest: array [1..200] of string;  // nomes para restricoes criadas
  EdtTotal: array [1..20] of string; //nomes para totais
  CmbBox: array [1..20] of string; //nomes para comboBox criados
  EdtVarUsado: integer; // armazena nmr de nomes utilizados em variaveis
  EdtRestUsado: integer; // armazena nmr de nomes utilizados em restricoes
  EdtTotUsado: integer; //armazena nmr de nomes utilizados em totais
  CmbBoxUsado: integer; //armazena nmr de nomes utilizados em comboBoxs

const
  FOL = 216;      //Funcao Objetivo Left
  FOT = 72;       //Funcao Objetivo Top
  EW = 23;        //Edit Width
  EH = 21;        //Edit Height
  RL = 154;       //Restricao Left
  RT = 224;       //Restricao Top

implementation

{$R *.dfm}

procedure zeraSimplex();
var i,j:integer;
begin
  for i:= 1 to 50 do
    begin
      for j:= 1 to 50 do
        begin
          simplex[i,j] := 0;
        end;
    end;
end;

procedure nomeiaEdit();
var i:integer;
begin
  for i := 1 to 50 do
    begin
      EdtVar[i] := 'variavelX' + IntToStr(i + 4);
    end;
  for i := 1 to 200 do
    begin
      EdtRest[i] := 'restricao' + IntToStr(i + 16);
    end;
  for i := 1 to 20 do
    begin
      EdtTotal[i] := 'total' + IntToStr(i + 4);
    end;
  for i := 1 to 20 do
    begin
      CmbBox[i] := 'combobox' + IntToStr(i + 4);
    end;
end;

procedure TfrmSimplex.FormShow(Sender: TObject);
begin
  EdtVarUsado := 0;
  EdtRestUsado := 0;
  EdtTotUsado := 0;
  CmbBoxUsado := 0;
  qtdVariavel := 0;
  qtdRestricao := 0;
  zeraSimplex;
  nomeiaEdit;
end;

procedure TfrmSimplex.Button2Click(Sender: TObject);
var a:TEdit;
b:TLabel;
i:integer;
begin
  qtdVariavel := qtdVariavel + 1;
  EdtVarUsado := EdtVarUsado + 1;
  a := TEdit.Create(Self);
  a.Parent := frmSimplex;
  a.SetBounds(FOL + ((EW + 3) * qtdVariavel), FOT, EW, EH);
  a.Name := EdtVar[EdtVarUsado];
  a.Text := '';
  for i := 1 to 4 + qtdRestricao do
    begin
      if i = 1 then
        begin
// ADD EDIT
          EdtRestUsado := EdtRestUsado + 1;
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(ComboBox1.Left, RT - ((EH + 3)*3), EW, EH);
          a.Name := EdtRest[EdtRestUsado];
          a.Text := '';
        end
      else
        begin
// ADD EDIT
          EdtRestUsado := EdtRestUsado + 1;
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(ComboBox1.Left ,RT - ((EH + 3)*(4-i)), EW, EH);
          a.Name := EdtRest[EdtRestUsado];
          a.Text := '';
        end;
    end;
// ADD LABEL
  b := TLabel.Create(Self);
  b.Parent :=  Panel1;
  b.SetBounds(236 + (26 * qtdVariavel), 136, 16, 13);
  b.Caption := 'X' + IntToStr(4 + qtdVariavel);
  b.Name := 'X' + IntToStr(4 + qtdVariavel);
// TESTE
  ComboBox1.Left := ComboBox1.Left + EW + 3;
  ComboBox2.Left := ComboBox2.Left + EW + 3;
  ComboBox3.Left := ComboBox3.Left + EW + 3;
  ComboBox4.Left := ComboBox4.Left + EW + 3;
  total1.Left := total1.Left + EW + 3;
  total2.Left := total2.Left + EW + 3;
  total3.Left := total3.Left + EW + 3;
  total4.Left := total4.Left + EW + 3;
  Label7.Left := Label7.Left + EW + 3;
  Label8.Left := Label8.Left + EW + 3;
end;

procedure TfrmSimplex.Button3Click(Sender: TObject);
var a:TEdit;
b:TComboBox;
i:integer;
begin
  qtdRestricao := qtdRestricao + 1;
  for i := 1 to 4 + qtdVariavel do
    begin
      if i = 1 then
        begin
// ADD EDIT
          EdtRestUsado := EdtRestUsado + 1;
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(RL, RT + ((EH + 3) * qtdRestricao), EW, EH);
          a.Name := EdtRest[EdtRestUsado];
          a.Text := '';
        end
      else
        begin
// ADD EDIT RESTRICAO
          EdtRestUsado := EdtRestUsado + 1;
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(RL + ((EW + 3)* (i-1)), RT + ((EH + 3) * qtdRestricao), EW, EH);
          a.Name := EdtRest[EdtRestUsado];
          a.Text := '';
        end;
    end;
// ADD COMBOBOX TIPO RESTRICAO
  CmbBoxUsado := CmbBoxUsado + 1;
  b := TComboBox.Create(Self);
  b.Parent := frmSimplex;
  b.Items.Add('>=');
  b.Items.Add('<=');
  b.SetBounds(combobox1.Left, RT + ((EH + 3)* qtdRestricao), 39, 21);
  b.Name := CmbBox[CmbBoxUsado];
  b.Text := '';
// ADD EDIT TOTAL
  EdtTotUsado := EdtTotUsado + 1;
  a := TEdit.Create(Self);
  a.Parent := frmSimplex;
  a.SetBounds(total1.Left, RT + ((EH + 3)* qtdRestricao), 33, 21);
  a.Name := EdtTotal[EdtTotUsado];
  a.Text := '';
end;

end.
