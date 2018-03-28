unit UJogoRaposa;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, jpeg, UClasses, StdCtrls;

type
  TfrmJogo = class(TForm)
    Panel1: TPanel;
    Image1: TImage;
    tmrBalaca: TTimer;
    procedure FormShow(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure tmrBalacaTimer(Sender: TObject);
  private
    { Private declarations }
    jrPecas: array [1..14] of TPeca;     //1..13 gansos 14 raposa
    jrTabuleiro:TTabuleiro;
    jrMovimento: array [1..16] of TPeca; // movimento
    jrPecaClicada:TPeca;                 // peca candidata p/movimento
    jrVez:Boolean;                       // true gansos false raposa
    jrNmrGansos:integer;                 // Quando = 3 Raposa vence (talvez possa tirar [ganso.destroy])
    jrQtdMov:integer;                    // para indice de jrMovimento
    jrGansoMorto:TPeca;                  // balacas inúteis
    procedure PecaClick(Sender:TObject);
    procedure MovimentoClick(Sender:TObject);
    procedure MovimentoComeClick(Sender:TObject);
    procedure TestaMovimento(peca:TPeca);  // aqui está o teste da vitória, pensar em melhorar.
    function TestaNovoMovimento(x,y:integer):boolean;  //raposa only
    procedure CriaMovimento(x,y,indice:integer;tipoMov:TTipoObj);
    procedure DestroyMovimento;
    procedure MataGanso(direcao:integer); //direcao = 0:esquerda;1:direita;2:cima;3:baixo;
  public
    { Public declarations }
  end;

var
  frmJogo: TfrmJogo;


implementation

uses UGansosWin, URaposaWin;

{$R *.dfm}

procedure TfrmJogo.FormShow(Sender: TObject);
var i: integer;
begin
  jrVez := True;
  jrQtdMov := 0;
  jrNmrGansos := 13;
  jrTabuleiro := TTabuleiro.Create;
  jrGansoMorto := TPeca.Create(50); // nmr que sei que não vai bugar
  jrGansoMorto.SetTipo(toMovN);
  for i := 1 to 13 do
  begin
    jrPecas[i] := TPeca.Create(i);
    jrPecas[i].SetTipo(toGanso);
    jrPecas[i].SetImagem(toGanso,Panel1,'imagens\gansoPeca.jpg');
//    jrPecas[i].SetImagem(toGanso,Panel1,'imagens\ganso6.jpg');
    case i of
      1..3:
      begin
        jrPecas[i].SetPosicao(i+2,1);
        jrTabuleiro.SetOcupado(i+2,1,i);
      end;
      4..6:
      begin
        jrPecas[i].SetPosicao(i-1,2);
        jrTabuleiro.SetOcupado(i-1,2,i);
      end;
      7..13:
      begin
        jrPecas[i].SetPosicao(i-6,3);
        jrTabuleiro.SetOcupado(i-6,3,i);
      end;
    end;
  end;
  jrPecas[14] := TPeca.Create(14);
  jrPecas[14].SetTipo(toRaposa);
  jrPecas[14].SetImagem(toRaposa,Panel1,'imagens\raposaPeca.bmp');
//  jrPecas[14].SetImagem(toRaposa,Panel1,'imagens\raposa7.jpg');
  jrPecas[14].SetPosicao(4,6);
  jrTabuleiro.SetOcupado(4,6,14);

  for i := 1 to 14 do
    jrPecas[i].SetClick(PecaClick);
end;

procedure TfrmJogo.FormClose(Sender: TObject; var Action: TCloseAction);
var i:integer;
begin
  for i := 1 to 14 do
  begin
    if jrPecas[i] <> nil then
      jrPecas[i].Destroy;
  end;
  jrTabuleiro.Destroy;
end;

procedure TfrmJogo.PecaClick(Sender: TObject);
begin
  if (((jrPecas[(Sender as TImage).Tag].GetTipo = toGanso) and (jrVez = True))
  or ((jrPecas[(Sender as TImage).Tag].GetTipo = toRaposa) and (jrVez = False))) then
  begin
    if jrPecaClicada = nil then
    begin
      jrPecaClicada := jrPecas[(Sender as TImage).Tag];
      TestaMovimento(jrPecas[(Sender as TImage).Tag]);
    end else
    begin
      jrPecaClicada := nil;
      DestroyMovimento;
    end;
  end;  
end;

procedure TfrmJogo.CriaMovimento(x,y,indice:integer;tipoMov:TTipoObj);
begin
  jrMovimento[indice] := TPeca.Create(indice);
  jrMovimento[indice].SetTipo(tipoMov);
  jrMovimento[indice].SetImagem(tipoMov,Panel1,'imagens\movimento.bmp');
  jrMovimento[indice].SetPosicao(x,y);
  if tipoMov = toMovN then
    jrMovimento[indice].SetClick(MovimentoClick)
  else
    jrMovimento[indice].SetClick(MovimentoComeClick)
end;

function TfrmJogo.TestaNovoMovimento(x,y:integer):boolean;
begin
  result := false;
  if ((jrTabuleiro.GetPosXY(x-1,y) <> 0) and (jrTabuleiro.GetPosXY(x-2,y) = 0)) then
  begin
    Inc(jrQtdMov);
    CriaMovimento(x-2,y,jrQtdMov,toMovC);
    result := true;
  end;
  if ((jrTabuleiro.GetPosXY(x+1,y) <> 0) and (jrTabuleiro.GetPosXY(x+2,y) = 0)) then
  begin
    Inc(jrQtdMov);
    CriaMovimento(x+2,y,jrQtdMov,toMovC);
    result := true;
  end;
  if ((jrTabuleiro.GetPosXY(x,y+1) <> 0) and (jrTabuleiro.GetPosXY(x,y+2) = 0)) then
  begin
    Inc(jrQtdMov);
    CriaMovimento(x,y+2,jrQtdMov,toMovC);
    result := true;
  end;
  if ((jrTabuleiro.GetPosXY(x,y-1) <> 0) and (jrTabuleiro.GetPosXY(x,y-2) = 0)) then
  begin
    Inc(jrQtdMov);  
    CriaMovimento(x,y-2,jrQtdMov,toMovC);
    result := true;
  end;
end;

procedure TfrmJogo.TestaMovimento(peca: TPeca);
var x,y:integer;
begin
  x := peca.GetPosX;
  y := peca.GetPosY;
  if peca.GetTipo = toGanso then
  begin
    if jrNmrGansos <= 3 then
      frmRaposaWin.ShowModal;
    if jrTabuleiro.GetPosXY(x+1,y) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x+1,y,jrQtdMov,toMovN);
    end;
    if jrTabuleiro.GetPosXY(x-1,y) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x-1,y,jrQtdMov,toMovN);
    end;
    if jrTabuleiro.GetPosXY(x,y+1) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x,y+1,jrQtdMov,toMovN);
    end;
    if jrTabuleiro.GetPosXY(x,y-1) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x,y-1,jrQtdMov,toMovN);
    end;
  end else //RAPOSA
  begin
    if jrTabuleiro.GetPosXY(x+1,y) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x+1,y,jrQtdMov,toMovN);
    end else
    begin
      if jrTabuleiro.GetPosXY(x+2,y) = 0 then //TESTA SE PODE COMER
      begin
        Inc(jrQtdMov);
        CriaMovimento(x+2,y,jrQtdMov,toMovC);
      end;
    end;
    if jrTabuleiro.GetPosXY(x-1,y) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x-1,y,jrQtdMov,toMovN);
    end else
    begin
      if jrTabuleiro.GetPosXY(x-2,y) = 0 then //TESTA SE PODE COMER
      begin
        Inc(jrQtdMov);
        CriaMovimento(x-2,y,jrQtdMov,toMovC);
      end;
    end;
    if jrTabuleiro.GetPosXY(x,y+1) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x,y+1,jrQtdMov,toMovN);
    end else
    begin
      if jrTabuleiro.GetPosXY(x,y+2) = 0 then //TESTA SE PODE COMER
      begin
        Inc(jrQtdMov);
        CriaMovimento(x,y+2,jrQtdMov,toMovC);
      end;
    end;
    if jrTabuleiro.GetPosXY(x,y-1) = 0 then
    begin
      Inc(jrQtdMov);
      CriaMovimento(x,y-1,jrQtdMov,toMovN);
    end else
    begin
      if jrTabuleiro.GetPosXY(x,y-2) = 0 then //TESTA SE PODE COMER
      begin
        Inc(jrQtdMov);
        CriaMovimento(x,y-2,jrQtdMov,toMovC);
      end;
    end;
    if jrQtdMov = 0 then
      frmGansoWin.ShowModal;
  end;
end;

procedure TfrmJogo.MovimentoClick(Sender: TObject);
var i:integer;
begin
  jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX,jrPecaClicada.GetPosY,0);
  jrPecaClicada.SetPosicao((jrMovimento[(Sender as TImage).Tag].GetPosX),(jrMovimento[(Sender as TImage).Tag].GetPosY));
  jrTabuleiro.SetOcupado(jrMovimento[(Sender as TImage).Tag].GetPosX,jrMovimento[(Sender as TImage).Tag].GetPosY,jrPecaClicada.GetCodigo);
  jrPecaClicada := nil;
  DestroyMovimento;
  jrVez := not jrVez;  
end;

procedure TfrmJogo.MovimentoComeClick(Sender: TObject);
var x,y:integer;
begin
  x := jrPecaClicada.GetPosX;
  y := jrPecaClicada.GetPosY;
  jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX,jrPecaClicada.GetPosY,0);
  jrPecaClicada.SetPosicao((jrMovimento[(Sender as TImage).Tag].GetPosX),(jrMovimento[(Sender as TImage).Tag].GetPosY));
  jrTabuleiro.SetOcupado(jrMovimento[(Sender as TImage).Tag].GetPosX,jrMovimento[(Sender as TImage).Tag].GetPosY,jrPecaClicada.GetCodigo);
  if x > jrPecaClicada.GetPosX then
    MataGanso(1);
  if x < jrPecaClicada.GetPosX then
    MataGanso(0);
  if y > jrPecaClicada.GetPosY then
    MataGanso(2);
  if y < jrPecaClicada.GetPosY then
    MataGanso(3);

  DestroyMovimento;    
  if not TestaNovoMovimento(jrPecaClicada.GetPosX,jrPecaClicada.GetPosY) then
  begin
    jrPecaClicada := nil;
    jrVez := not jrVez;
  end;
end;

procedure TfrmJogo.DestroyMovimento;
var i:integer;
begin
  for i := 1 to jrQtdMov do
  begin
    if jrMovimento[i] <> nil then
    begin
      jrMovimento[i].Destroy;
      jrMovimento[i] := nil;
    end;
  end;
  jrQtdMov := 0;
end;


procedure TfrmJogo.MataGanso(direcao:integer);
//direcao = 0:esquerda;1:direita;2:cima;3:baixo;
var index:integer;
begin
  case direcao of
    0:
    begin
      index := jrTabuleiro.GetPosXY(jrPecaClicada.GetPosX-1, jrPecaClicada.GetPosY);
      jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX-1, jrPecaClicada.GetPosY,0);
      jrGansoMorto.SetImagem(toMovN,Panel1,'imagens\gansoMorto.jpg');
      jrGansoMorto.SetPosicao(jrPecaClicada.GetPosX-1, jrPecaClicada.GetPosY);
      tmrBalaca.Enabled := True;
      jrPecas[index].Destroy;
      jrPecas[index] := nil;
    end;
    1:
    begin
      index := jrTabuleiro.GetPosXY(jrPecaClicada.GetPosX+1, jrPecaClicada.GetPosY);
      jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX+1, jrPecaClicada.GetPosY,0);
      jrGansoMorto.SetImagem(toMovN,Panel1,'imagens\gansoMorto.jpg');
      jrGansoMorto.SetPosicao(jrPecaClicada.GetPosX+1, jrPecaClicada.GetPosY);
      tmrBalaca.Enabled := True;
      jrPecas[index].Destroy;
      jrPecas[index] := nil;
    end;
    2:
    begin
      index := jrTabuleiro.GetPosXY(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY+1);
      jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY+1,0);
      jrGansoMorto.SetImagem(toMovN,Panel1,'imagens\gansoMorto.jpg');
      jrGansoMorto.SetPosicao(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY+1);
      tmrBalaca.Enabled := True;
      jrPecas[index].Destroy;
      jrPecas[index] := nil;
    end;
    3:
    begin
      index := jrTabuleiro.GetPosXY(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY-1);
      jrTabuleiro.SetOcupado(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY-1,0);
      jrGansoMorto.SetImagem(toMovN,Panel1,'imagens\gansoMorto.jpg');
      jrGansoMorto.SetPosicao(jrPecaClicada.GetPosX, jrPecaClicada.GetPosY-1);
      tmrBalaca.Enabled := True;
      jrPecas[index].Destroy;
      jrPecas[index] := nil;
    end;
  end;
  jrNmrGansos := jrNmrGansos-1;
  if jrNmrGansos <= 3 then
    frmRaposaWin.ShowModal;
end;

procedure TfrmJogo.tmrBalacaTimer(Sender: TObject);
begin
  jrGansoMorto.Destroy;
  jrGansoMorto := TPeca.Create(50);
  tmrBalaca.Enabled := False;
end;

end.
