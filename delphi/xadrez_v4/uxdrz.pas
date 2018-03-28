unit uxdrz;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, jpeg, StdCtrls, Buttons, UXdrzClasses;

type
  TfmXadrez = class(TForm)
    imgFundo: TImage;
    pnlTabuleiro: TPanel;
    imgTabuleiro: TImage;
    edJogador1: TEdit;
    edJogador2: TEdit;
    Label1: TLabel;
    imgVez: TImage;
    Timer1: TTimer;
    procedure Timer1Timer(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure FormShow(Sender: TObject);
  private
    { Private declarations }
    procedure TrocarVez;
    procedure ConverteXYpLeftTop;
  public
    procedure CriaMovimentoPeca(Sender:TObject);
    procedure MovimentaPeca(Sender:TObject);
    procedure CancelaMovimento;
    function IdentificaQTDMov(peca:TPeca):integer;
    { Public declarations }
  end;

var
  fmXadrez: TfmXadrez;
  xPecas: array [1..32] of TPeca;
  xPecaSelecionada: TPeca;
  xtab: TTabuleiro;
  xMovimento: array [1..30] of TMovimento;

implementation

{$R *.dfm}

{************************************************************
 *************** Minhas procedures e functions ************** 
 ************************************************************}
 

procedure TfmXadrez.ConverteXYpLeftTop;
begin
//
end;

procedure TfmXadrez.CancelaMovimento;
var
  i:integer;
begin
  i := 1;
  while xMovimento[i] <> nil do
  begin
    xMovimento[i].Destroy;
    Inc(i);
  end;
end;

procedure TfmXadrez.CriaMovimentoPeca(Sender: TObject);
var i:integer;
begin
  if xPecaSelecionada = nil then
    xPecaSelecionada := xPecas[(Sender as TImage).Tag]
  else begin
    xPecaSelecionada := nil;
    CancelaMovimento;
    Exit;
  end;

  for i := 1 to IdentificaQTDMov(xPecas[(Sender as TImage).Tag]) do
  begin
    xMovimento[i] := TMovimento.Create(pnlTabuleiro,i);
    xPecas[(Sender as TImage).Tag].MovimentaPeca(xPecas[(Sender as TImage).Tag]);
    xMovimento[i].SetMovDisponivel(xPecas[(Sender as TImage).Tag]);
    xMovimento[i].SetImagemMov('imagens\movimento2.bmp');
    xMovimento[i].GetMovDisponivel(xPecas[(Sender as TImage).Tag]);
    xMovimento[i].mImagem.OnClick := MovimentaPeca;
  end;
end;

procedure TfmXadrez.MovimentaPeca(Sender: TObject);
var
  i:integer;
begin
  i := 1;
  xMovimento[(Sender as TImage).Tag].MovimentaPeca(xPecaSelecionada,xtab);
  CancelaMovimento;  //aqui o problema
  xPecaSelecionada := nil;
end;

function TfmXadrez.IdentificaQTDMov(peca:TPeca): integer;
var
  x,y,cont:integer;
begin
  x := peca.GetPosXPeca;
  y := peca.GetPosYPeca;

  case peca.GetTipo of
    tpPeao:
    begin
      if peca.GetCor = cpBranca then
      begin
        if xtab.GetTabGeral(x,y+1) then
          cont := 1;
      end else
      begin
        if xtab.GetTabGeral(x,y-1) then
          cont := 1;
      end;
    end;
    tpTorre:
    begin
    end;
    tpCavalo:
    begin
    end;
    tpBispo:
    begin
    end;
    tpRainha:
    begin
    end;
    tpRei:
    begin
    end;
  end;
  result := cont;
end;

procedure TfmXadrez.TrocarVez;
begin
  if imgVez.Left = 203 then
    imgVez.Left := 393
  else
    imgVez.Left := 203;
end;

{************************************************************
 *************** Fim das procedures e functions *************
 ************************************************************}

procedure TfmXadrez.Timer1Timer(Sender: TObject);
var
  a,b:integer;
begin
  b := StrToInt(Copy(label1.Caption,0,1));
  a := StrToInt(Copy(label1.Caption,3,4));
  if a = 0 then
  begin
    if b = 0 then
    begin
      TrocarVez;
      Inc(b);
    end else
      Dec(b);
    a := 59;
  end else
    Dec(a);

  if a < 10 then
    Label1.Caption := IntToStr(b)+':0'+IntToStr(a)
  else
    Label1.Caption := IntToStr(b)+':'+IntToStr(a);
end;

procedure TfmXadrez.FormClose(Sender: TObject; var Action: TCloseAction);
var
  i:integer;
begin
  if xtab <> nil then
    xtab.Destroy;
  for i := 1 to 32 do
    if xPecas[i] <> nil then
      xPecas[i].Destroy;
  for i := 1 to 30 do
    if xMovimento[i] <> nil then
      xMovimento[i].Destroy;
end;

procedure TfmXadrez.FormShow(Sender: TObject);
{
  pecas index:

  --BRANCAS-- (acima)
  1 - torre
  2 - cavalo
  3 - bispo
  4 - rei
  5 - rainha
  6 - bispo
  7 - cavalo
  8 - torre
  9a16 - peoes
  --PRETAS--(abaixo)
  17 - torre
  18 - cavalo
  19 - bispo
  20 - rainha
  21 - rei
  22 - bispo
  23 - cavalo
  24 - torre
  25a32 - peoes
}
var
  i:integer;
begin
  xtab := TTabuleiro.Create;
  for i := 1 to 32 do
  begin
    case i of
      1..8:
      begin
      //pecas valiosas brancas
        if ((i <> 2) or (i <> 7)) then
          xPecas[i] := TPeca.Create(pnlTabuleiro,i)
        else
          xPecas[i] := TCavalo.Create(pnlTabuleiro,i);
        xPecas[i].SetPosPeca(i,1,i,xtab);
        case i of
          1,8:
          begin
            xPecas[i].SetTipo(tpTorre);
            xPecas[i].SetImagem('imagens\torre_branco.bmp');
          end;
          2,7:
          begin
            xPecas[i].SetTipo(tpCavalo);
            xPecas[i].SetImagem('imagens\cavalo_branco.bmp');
          end;
          3,6:
          begin
            xPecas[i].SetTipo(tpBispo);
            xPecas[i].SetImagem('imagens\bispo_branco.bmp');
          end;
          4:
          begin
            xPecas[i].SetTipo(tpRei);
            xPecas[i].SetImagem('imagens\rei_branco.bmp');
          end;
          5:
          begin
            xPecas[i].SetTipo(tpRainha);
            xPecas[i].SetImagem('imagens\rainha_branco.bmp');
          end;
        end;
        xPecas[i].SetCor(cpBranca);
      end;
      9..16:
      begin
      //peoes brancos
        xPecas[i] := TPeca.Create(pnlTabuleiro,i);
        xPecas[i].SetTipo(tpPeao);
        xPecas[i].SetImagem('imagens\peao_branco.bmp');
        xPecas[i].SetCor(cpBranca);
        xPecas[i].SetPosPeca(i-8,2,i,xtab);
      end;
      17..24:
      begin
      //pecas valiosas pretas
        if ((i <> 18) or (i <> 24)) then
          xPecas[i] := TPeca.Create(pnlTabuleiro,i)
        else
          xPecas[i] := TCavalo.Create(pnlTabuleiro,i);
        xPecas[i].SetPosPeca(i-16,8,i,xtab);
        case i of
          17,24:
          begin
            xPecas[i].SetTipo(tpTorre);
            xPecas[i].SetImagem('imagens\torre_preto.bmp');
          end;
          18,23:
          begin
            xPecas[i].SetTipo(tpCavalo);
            xPecas[i].SetImagem('imagens\cavalo_preto.bmp');
          end;
          19,22:
          begin
            xPecas[i].SetTipo(tpBispo);
            xPecas[i].SetImagem('imagens\bispo_preto.bmp');
          end;
          20:
          begin
            xPecas[i].SetTipo(tpRei);
            xPecas[i].SetImagem('imagens\rainha_preto.bmp');
          end;
          21:
          begin
            xPecas[i].SetTipo(tpRainha);
            xPecas[i].SetImagem('imagens\rei_preto.bmp');
          end;
        end;
        xPecas[i].SetCor(cpPreta);
      end;
      25..32:
      begin
      //peoes pretos
        xPecas[i] := TPeca.Create(pnlTabuleiro,i);
        xPecas[i].SetTipo(tpPeao);
        xPecas[i].SetImagem('imagens\peao_preto.bmp');
        xPecas[i].SetCor(cpPreta);
        xPecas[i].SetPosPeca(i-24,7,i,xtab);
      end;
    end;
    xPecas[i].SetCodPeca(i);
    xPecas[i].pImagem.OnClick := CriaMovimentoPeca;
  end;
end;

end.
