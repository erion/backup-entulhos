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
    Edit4: TEdit;
    Edit3: TEdit;
    Edit2: TEdit;
    Edit1: TEdit;
    Label2: TLabel;
    Edit5: TEdit;
    Edit6: TEdit;
    Edit7: TEdit;
    Edit8: TEdit;
    ComboBox1: TComboBox;
    Edit21: TEdit;
    Edit22: TEdit;
    Edit23: TEdit;
    Edit24: TEdit;
    ComboBox4: TComboBox;
    ComboBox3: TComboBox;
    ComboBox2: TComboBox;
    Edit11: TEdit;
    Edit12: TEdit;
    Edit16: TEdit;
    Edit20: TEdit;
    Edit19: TEdit;
    Edit15: TEdit;
    Edit10: TEdit;
    Edit14: TEdit;
    Edit18: TEdit;
    Edit17: TEdit;
    Edit13: TEdit;
    Edit9: TEdit;
    Label3: TLabel;
    Button2: TButton;
    ComboBox5: TComboBox;
    CheckBox1: TCheckBox;
    CheckBox2: TCheckBox;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Button3: TButton;
    procedure FormShow(Sender: TObject);
    procedure ComboBox5Select(Sender: TObject);
    procedure CheckBox1Click(Sender: TObject);
    procedure CheckBox2Click(Sender: TObject);
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
  nomeEdit: array [1..100] of string;  // nomes para edits criados
  nomeEdtUsado: integer; // armazena nmr de nomes utilizados

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
  for i := 1 to 100 do
    begin
      nomeEdit[i] := 'edt' + IntToStr(i);
    end;
end;

procedure TfrmSimplex.FormShow(Sender: TObject);
begin
  qtdVariavel := 0;
  qtdRestricao := 0;
  zeraSimplex;
  nomeiaEdit;
end;

procedure TfrmSimplex.ComboBox5Select(Sender: TObject);
begin
  case ComboBox5.ItemIndex of
  0: begin
       ComboBox1.ItemIndex := 0;
       ComboBox2.ItemIndex := 0;
       ComboBox3.ItemIndex := 0;
       ComboBox4.ItemIndex := 0;
     end;
  1: begin
       ComboBox1.ItemIndex := 1;
       ComboBox2.ItemIndex := 1;
       ComboBox3.ItemIndex := 1;
       ComboBox4.ItemIndex := 1;
     end;
  end;
end;

procedure TfrmSimplex.CheckBox1Click(Sender: TObject);
begin
  if CheckBox1.Checked then
    begin
      edit13.Enabled := False;
      edit14.Enabled := False;
      edit15.Enabled := False;
      edit16.Enabled := False;
      edit23.Enabled := False;
      ComboBox3.Enabled := False;
    end
  else
    begin
      edit13.Enabled := True;
      edit14.Enabled := True;
      edit15.Enabled := True;
      edit16.Enabled := True;
      edit23.Enabled := True;
      ComboBox3.Enabled := True;
    end;
end;

procedure TfrmSimplex.CheckBox2Click(Sender: TObject);
begin
  if CheckBox2.Checked then
    begin
      edit17.Enabled := False;
      edit18.Enabled := False;
      edit19.Enabled := False;
      edit20.Enabled := False;
      edit24.Enabled := False;
      ComboBox4.Enabled := False;
    end
  else
    begin
      edit17.Enabled := True;
      edit18.Enabled := True;
      edit19.Enabled := True;
      edit20.Enabled := True;
      edit24.Enabled := True;
      ComboBox4.Enabled := True;
    end;
end;

procedure TfrmSimplex.Button2Click(Sender: TObject);
var a:TEdit;
i:integer;
begin
  qtdVariavel := qtdVariavel + 1;
  a := TEdit.Create(Self);
  a.Parent := frmSimplex;
  a.SetBounds(FOL + ((EW + 3) * qtdVariavel), FOT, EW, EH);
  a.Name := 'edt' + IntToStr(qtdVariavel);
  a.Text := '';
  for i := 1 to 4 + qtdRestricao do
    begin
      if i = 1 then
        begin
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(ComboBox1.Left, RT - ((EH + 3)*3), EW, EH);
//          a.Name := 'restricao' + IntToStr(i) + 'edt' + IntToStr(qtdVariavel);
          a.Text := '';
        end
      else
        begin
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(ComboBox1.Left ,RT - ((EH + 3)*(4-i)), EW, EH);
//          a.Name := 'restricao' + IntToStr(i) + 'edt' + IntToStr(qtdVariavel);
          a.Text := '';
        end;
    end;
// TESTE
  ComboBox1.Left := ComboBox1.Left + EW + 3;
  ComboBox2.Left := ComboBox2.Left + EW + 3;
  ComboBox3.Left := ComboBox3.Left + EW + 3;
  ComboBox4.Left := ComboBox4.Left + EW + 3;
  Edit21.Left := Edit21.Left + EW + 3;
  Edit22.Left := Edit22.Left + EW + 3;
  Edit23.Left := Edit23.Left + EW + 3;
  Edit24.Left := Edit24.Left + EW + 3;
  Label7.Left := Label7.Left + EW + 3;
  Label8.Left := Label8.Left + EW + 3;
end;

procedure TfrmSimplex.Button3Click(Sender: TObject);
var a:TEdit;
i:integer;
begin
  qtdRestricao := qtdRestricao + 1;
  for i := 1 to 4 + qtdVariavel do
    begin
      if i = 1 then
        begin
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(RL, RT + ((EH + 3) * qtdRestricao), EW, EH);
//          a.Name := 'restricao' + IntToStr(qtdRestricao) + 'edt' + IntToStr(i);
          a.Text := '';
        end
      else
        begin
          a := TEdit.Create(Self);
          a.Parent := frmSimplex;
          a.SetBounds(RL + ((EW + 3)* (i-1)), RT + ((EH + 3) * qtdRestricao), EW, EH);
//          a.Name := 'restricao' + IntToStr(qtdRestricao) + 'edt' + IntToStr(i);
          a.Text := '';
        end;
    end;
end;

end.
