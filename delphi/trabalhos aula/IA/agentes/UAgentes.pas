unit UAgentes;

{
  Aluno: Erion Dreyer                                       Trabalho IA: Agentes
  Prof.: Fabian                                                  Feevale 2008/01
                                                                              3N


  Obs1.:
  ainda estou para entender pq a posição 0,0 é o topo a esquerda da grid.
  então, ao verificar posições, contar o ponto de origem como o topo a esquerda
  Obs2.:
  agentes as vzs ficam tempos sem movimentar pois implementei p/se for movimentar p/
  o mesmo local que estava a um movimento anterior, não anda.
}

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, Grids, ExtCtrls, jpeg, UClasses, StdCtrls, ComCtrls;

const
  totalAgentes : integer = 10;

type
  TfrmAgentes = class(TForm)
    Panel1: TPanel;
    DrawGrid1: TDrawGrid;
    imgCasaP: TImage;
    imgAgenteP: TImage;
    Timer1: TTimer;
    RadioGroup1: TRadioGroup;
    chkDetalhes: TCheckBox;
    imgCasaV: TImage;
    imgAgenteV: TImage;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Edit1: TEdit;
    btnAlterar: TButton;
    btnReiniciar: TButton;
    Memo1: TMemo;
    chkProntos: TCheckBox;
    RichEdit1: TRichEdit;
    Label6: TLabel;
    procedure DrawGrid1DrawCell(Sender: TObject; ACol, ARow: Integer;
      Rect: TRect; State: TGridDrawState);
    procedure FormShow(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure RadioGroup1Click(Sender: TObject);
    procedure btnAlterarClick(Sender: TObject);
    procedure btnReiniciarClick(Sender: TObject);
    procedure chkDetalhesClick(Sender: TObject);
    procedure chkProntosClick(Sender: TObject);
  private
    { Private declarations }
    aAgentes: array[1..10] of TAgente;
    aCasas: array[1..10] of TAgente;
    aTabuleiro: TTabuleiro;
  public
    { Public declarations }
  end;

var
  frmAgentes: TfrmAgentes;

implementation

{$R *.dfm}

procedure TfrmAgentes.DrawGrid1DrawCell(Sender: TObject; ACol,
  ARow: Integer; Rect: TRect; State: TGridDrawState);
var
  i,j:integer;
begin
  for i := 1 to totalAgentes do
  begin
    if ((aAgentes[i].GetPosX = ACol) and (aAgentes[i].GetPosY = ARow)) then
    begin
      if aAgentes[i].GetTipo = toAgenteP then
        DrawGrid1.Canvas.Draw(Rect.Left,Rect.Top,imgAgenteP.Picture.Graphic)
      else
        DrawGrid1.Canvas.Draw(Rect.Left,Rect.Top,imgAgenteV.Picture.Graphic)
    end;
  end;
  for i := 1 to totalAgentes do
  begin
    if ((ACol = aCasas[i].GetPosX ) and (ARow = aCasas[i].GetPosY)) then
    begin
      if aCasas[i].GetTipo = toCasaP then
        DrawGrid1.Canvas.Draw(Rect.Left,Rect.Top,imgCasaP.Picture.Graphic)
      else
        DrawGrid1.Canvas.Draw(Rect.Left,Rect.Top,imgCasaV.Picture.Graphic)
    end;
  end;  
end;

procedure TfrmAgentes.FormShow(Sender: TObject);
var
  i,j:integer;
begin
  aTabuleiro := TTabuleiro.Create;
  RadioGroup1.ItemIndex := 1;
  Randomize;
  for i := 1 to totalAgentes do
  begin
    aAgentes[i] := TAgente.Create;
    aAgentes[i].SetCodigo(i);
    aAgentes[i].SetPosicao(Random(22),Random(22));
    if i < 6 then
      aAgentes[i].SetTipo(toAgenteP)
    else
      aAgentes[i].SetTipo(toAgenteV);
    aTabuleiro.SetOcupado(aAgentes[i].GetPosX,aAgentes[i].GetPosY,aAgentes[i].GetCodigo);

    aCasas[i] := TAgente.Create;
    aCasas[i].SetCodigo(i+totalAgentes);
    aCasas[i].SetPosicao(Random(22),Random(22));
    if i < 6 then
    begin
      aCasas[i].SetTipo(toCasaP);
      aTabuleiro.SetOcupado(acasas[i].GetPosX, acasas[i].GetPosY,99);
    end else
    begin
      aCasas[i].SetTipo(toCasaV);
      aTabuleiro.SetOcupado(acasas[i].GetPosX, acasas[i].GetPosY,98);    
    end;
  end;
end;

procedure TfrmAgentes.Timer1Timer(Sender: TObject);
var i:integer;
begin
  Randomize;
  for i := 1 to totalAgentes do
    aAgentes[i].VerificaLados(aTabuleiro);
  DrawGrid1.Repaint;
end;

procedure TfrmAgentes.RadioGroup1Click(Sender: TObject);
begin
  Timer1.Enabled := RadioGroup1.ItemIndex = 0;
  chkDetalhes.Enabled := RadioGroup1.ItemIndex = 1;
  chkProntos.Enabled := chkDetalhes.Enabled;
  Edit1.Enabled := RadioGroup1.ItemIndex = 1;
  btnAlterar.Enabled := Edit1.Enabled;
  btnReiniciar.Enabled := RadioGroup1.ItemIndex = 1;
end;

procedure TfrmAgentes.btnAlterarClick(Sender: TObject);
var a:string;
begin
  a := Trim(edit1.Text);
  a := a + '000';
  try
    Timer1.Interval := StrToInt(a);
    MessageDlg('Intervalo de movimento alterado.',mtInformation,[mbOK],0);
  except
   on E:exception do
   begin
     MessageDlg('Não foi possível alterar o valor.'+#13+'Digite apenas números.'+#13+'Valor padrão restaurado (1s).',mtError,[mbOK],0);
     Timer1.Interval := 1000;
     Edit1.Text := '1';
   end;
  end;
end;

procedure TfrmAgentes.btnReiniciarClick(Sender: TObject);
var i:integer;
begin
// propositalmente não foi tratado peças no mesmo local, pois sendo casa apenas terá uma casa a menos, e sendo agente, na movimentação isso se corrige 
  for i := 1 to totalAgentes do
  begin
    aAgentes[i].Destroy;
    aAgentes[i] := nil;
    aCasas[i].Destroy;
    aCasas[i] := nil;
  end;
  aTabuleiro.Destroy;
  aTabuleiro := nil;
  FormShow(Self);
  DrawGrid1.Repaint;
end;

procedure TfrmAgentes.chkDetalhesClick(Sender: TObject);
var i:integer;
begin
  Memo1.Lines.Clear;
  chkProntos.Checked := not chkDetalhes.Checked;
  if chkDetalhes.Checked then
  begin
    for i := 1 to totalAgentes do
    begin
      if aAgentes[i].GetCasaEncontrada then
        Memo1.Lines.Add('Agente nº ' + IntToStr(aAgentes[i].GetCodigo) + ' - encontrou casa')
      else
        Memo1.Lines.Add('Agente nº ' + IntToStr(aAgentes[i].GetCodigo) + ' - não encontrou casa');
      if aAgentes[i].GetTipo = toAgenteP then
        Memo1.Lines.Add('  tipo: preto')
      else
        Memo1.Lines.Add('  tipo: vermelho');
      Memo1.Lines.Add('  posição X,Y: ' + IntToStr(aagentes[i].GetPosX) +','+ IntToStr(aagentes[i].GetPosY));
    end;
  end;
end;

procedure TfrmAgentes.chkProntosClick(Sender: TObject);
var i:integer;
begin
  Memo1.Lines.Clear;
  chkDetalhes.Checked := not chkProntos.Checked;
  if chkProntos.Checked then
  begin
    for i := 1 to totalAgentes do
    begin
      if aAgentes[i].GetCasaEncontrada then
      begin
        Memo1.Lines.Add('Agente nº ' + IntToStr(aAgentes[i].GetCodigo) + ' - encontrou casa');
        if aAgentes[i].GetTipo = toAgenteP then
          Memo1.Lines.Add('  tipo: preto')
        else
          Memo1.Lines.Add('  tipo: vermelho');
        Memo1.Lines.Add('  posição X,Y: ' + IntToStr(aagentes[i].GetPosX) +','+ IntToStr(aagentes[i].GetPosY));
      end;
    end;
  end;
end;

end.
