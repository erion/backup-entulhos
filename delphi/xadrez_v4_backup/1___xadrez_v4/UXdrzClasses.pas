unit UXdrzClasses;

interface

uses
  ExtCtrls, SysUtils, Forms, Controls, dialogs;

type

  TTabuleiro = class(TOBject)
    private
      tTabGeral: array [1..8,1..8] of integer;            // 0 - vazio; 1 - ocupado
      tTabPeca: array[1..8,1..8] of integer;              //armazena o codigo da peca em sua posicao
    public
      procedure SetTabGeral(x,y:integer;Vazio:boolean);   //vazio = true p/vazio, seta 0 p/posicao vazia e 1 para ocupada
      function GetTabGeral(x,y:integer):boolean;          //retorna true p/vazio
      procedure SetTabPeca(x,y,codPeca:integer);          //seta a peca a sua posicao
      function GetTabPeca(x,y:integer):integer;           //retorna o codigo da peca na posicao
  end;

  TTipoPeca = (tpPeao, tpTorre, tpCavalo, tpBispo, tpRainha, tpRei);

  TCorPeca = (cpBranca, cpPreta);

  TPeca = class(TObject)
    private
      pCodPeca: integer;
      pPosXY: array [1..2] of integer;
      pTipo: TTipoPeca;
      pCor: TCorPeca;
      procedure SetPosicaoImagem(x,y:integer);
    public
      pImagem:TImage;
      constructor Create(ImagemParent:TWinControl; CodigoPeca:integer);
      destructor Destroy;
      procedure SetCodPeca(codigo:integer);
      function GetCodPeca():integer;
      procedure SetPosPeca(x,y, codPeca:integer; Vtabuleiro:TTabuleiro);
      function GetPosXPeca():integer;
      function GetPosYPeca():integer;
      procedure SetTipo(tipo:TTipoPeca);
      function GetTipo:TTipoPeca;
      procedure SetCor(cor:TCorPeca);
      function GetCor:TCorPeca;
      procedure SetImagem(caminho:string);
      procedure MovimentaPeca(Sender:TObject);
      procedure MovimentaFrente(qtdCasas:integer);
      procedure MovimentaDiagonal(codDiag,qtdCasas:integer); 
  end;

  TCavalo = class(TPeca)
    private
    public
      function MovimentaCavalo(codMovimento:integer):Boolean; //retorna false caso não seja possível; (talvez não precise ser function)
  end;

  TMovimento = class
    private
      mCodigo:integer;
      mDisponivel: array [1..8,1..8] of integer;  //armazena 9 em posicoes [x],[y] disponiveis.
//      mImagem: TImage;
      mPosXY: array [1..2] of integer;
      mGerador: TPeca;
      mDistanciaX, mDistanciaY: integer;      //distancia da peca que gerou o movimento
    public
      mImagem: TImage;    
      constructor Create(ImagemParent:TWinControl; CodigoMovimento:integer);
      destructor Destroy;
      procedure SetCodigo(codMovimento:integer);
      function GetCodigo(Vmovimento:TMovimento):integer;
      procedure SetMovDisponivel(peca:TPeca); // identifica o tipo de peca para entao identificar a qtd d movimentos e direcoes
      procedure GetMovDisponivel(peca:TPeca); // cria imagens nas posicoes disponiveis
      procedure SetImagemMov(caminho:string);
      procedure SetPosXY(x,y:integer);
      function GetPosX():integer;
      function GetPosY():integer;
      procedure MovimentaPeca(peca:TPeca; tabuleiro:TTabuleiro);
  end;

implementation



{ TTabuleiro }

function TTabuleiro.GetTabGeral(x, y: integer): boolean;
//0 = vazio = true
begin
  result := tTabGeral[x,y] = 0;
end;

function TTabuleiro.GetTabPeca(x, y: integer): integer;
//retorna o codigo da peca
begin
  result := tTabPeca[x,y];
end;

procedure TTabuleiro.SetTabGeral(x, y: integer; Vazio: boolean);
begin
  if vazio then
    tTabGeral[x,y] := 0
  else
    tTabGeral[x,y] := 1;
end;

procedure TTabuleiro.SetTabPeca(x, y, codPeca: integer);
begin
  tTabPeca[x,y] := codPeca;
end;

{ TPeca }

constructor TPeca.Create(ImagemParent:TWinControl; CodigoPeca:integer);
begin
  pImagem := TImage.Create(nil);
  pImagem.Parent := ImagemParent;
  pImagem.Visible := True;
  pImagem.AutoSize := True;
  pImagem.BringToFront;
  pImagem.Transparent := True;
  pImagem.Tag := codigoPeca;
end;

destructor TPeca.Destroy;
begin
  FreeAndNil(pImagem);
end;

function TPeca.GetCodPeca(): integer;
begin
  result := pCodPeca;
end;

function TPeca.GetCor: TCorPeca;
begin
  result := pCor;
end;

function TPeca.GetPosXPeca(): integer;
begin
  result := pPosXY[1];
end;

function TPeca.GetPosYPeca(): integer;
begin
  result := pPosXY[2];
end;

function TPeca.GetTipo: TTipoPeca;
begin
  result := pTipo;
end;

procedure TPeca.MovimentaDiagonal(codDiag, qtdCasas: integer);
begin
//
end;

procedure TPeca.MovimentaFrente(qtdCasas: integer);
begin
//
end;

procedure TPeca.MovimentaPeca(Sender:TObject);
begin
  ShowMessage('posX: ' + IntToStr((Sender as TPeca).GetPosXPeca) + 'posY: ' + IntToStr((Sender as TPeca).GetPosYPeca));
end;

procedure TPeca.SetCodPeca(codigo: integer);
begin
  pCodPeca := codigo;
end;

procedure TPeca.SetCor(cor: TCorPeca);
begin
  pCor := cor;
end;

procedure TPeca.SetImagem(caminho: string);
begin
  pImagem.Picture.LoadFromFile(caminho);
end;

procedure TPeca.SetPosicaoImagem(x, y: integer);
{quadro = 49x45 margem de 7 em cada lado, 3,5 por quadro
 meio quadro = 24,5x22,5, pois quero a imagem centralizada}
var
  i:integer;
begin

  if x = 1 then
    pImagem.Left := 24
  else
    pImagem.Left := (56 * (x-1))+24;  //56 = 28 * 2 = (24,5 + 3,5) * 2

  if y = 1 then
    pImagem.Top := 0
  else
    pImagem.Top := (52 *(y-1));       // 52 = 26 * 2 = (22,5 + 3,5) * 2

end;

procedure TPeca.SetPosPeca(x, y, codPeca: integer; Vtabuleiro:TTabuleiro);
begin
  pPosXY[1] := x;
  pPosXY[2] := y;
  Vtabuleiro.tTabGeral[x,y] := 1;
  Vtabuleiro.tTabPeca[x,y] := codPeca;
  SetPosicaoImagem(x,y);
end;

procedure TPeca.SetTipo(tipo: TTipoPeca);
begin
  pTipo := tipo;
end;

{ TCavalo }

function TCavalo.MovimentaCavalo(codMovimento:integer): Boolean;
begin
//
end;

{ TMovimento }

constructor TMovimento.Create(ImagemParent: TWinControl;
  CodigoMovimento: integer);
begin
  mImagem := TImage.Create(nil);
  mImagem.Parent := ImagemParent;
  mImagem.Visible := True;
  mImagem.AutoSize := True;
  mImagem.BringToFront;
  mImagem.Tag := codigoMovimento;
  mImagem.left := 3;
  mImagem.top := 4;
end;

destructor TMovimento.Destroy;
begin
  FreeAndNil(mImagem);
end;

function TMovimento.GetCodigo(Vmovimento: TMovimento): integer;
begin
  result := Vmovimento.mCodigo;
end;

procedure TMovimento.GetMovDisponivel;
//posiciona as imagens de movimento em locais disponiveis
var
  i,j:integer;
begin
  for i := 1 to 8 do
  begin
    for j := 1 to 8 do
    begin
      if mDisponivel[i,j] = 9 then
      begin
        mImagem.Left := mImagem.Left + ((i-1)*28);
        mImagem.Top := mImagem.Top + ((j-1)*31);
      end;
    end;
  end;
end;

function TMovimento.GetPosX(): integer;
begin
  result := mPosXY[1];
end;

function TMovimento.GetPosY(): integer;
begin
  result := mPosXY[2];
end;

procedure TMovimento.MovimentaPeca(peca: TPeca; tabuleiro:TTabuleiro);
begin
  peca.SetPosicaoImagem(GetPosX,GetPosY);
  peca.SetPosPeca(GetPosX,GetPosY,peca.GetCodPeca,tabuleiro);
end;

procedure TMovimento.SetCodigo(codMovimento: integer);
begin
  mCodigo := codMovimento;
end;

procedure TMovimento.SetImagemMov(caminho: string);
begin
  mImagem.Picture.LoadFromFile(caminho);
end;

procedure TMovimento.SetMovDisponivel(peca: TPeca);
begin
//ainda falta testar posições vazias ou não do tabuleiro
  case peca.GetTipo of
    tpPeao:
    begin
      if peca.GetCor = cpBranca then
      begin
        if peca.GetPosYPeca = 2 then //primeiro movimento peao branco
        begin
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca+1] := 9;
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca+2] := 9;
        end else
        begin
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca+1] := 9;
        end;
      end else
      begin
        if peca.GetPosYPeca = 7 then //primeiro movimento peao preto
        begin
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca-1] := 9;
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca-2] := 9;
        end else
        begin
          mDisponivel[peca.GetPosXPeca,peca.GetPosYPeca-1] := 9;
        end;
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
end;

procedure TMovimento.SetPosXY(x, y: integer);
begin
  mPosXY[1] := x;
  mPosXY[2] := y;
end;

end.
