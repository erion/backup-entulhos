unit UClasses;

interface

uses
  ExtCtrls, Controls, SysUtils, Classes;

const

  QtdLeftMov :integer = 57;
  QtdTopMov  :integer = 53;

type

  TTipoObj = (toRaposa, toGanso, toMovN, toMovC); //movNormal, movComer

  TPeca = class(TObject)
    private
      pCodigo,
      pTop,
      pLeft,
      pX,
      pY :integer;
      pTipo:TTipoObj;
      pImagem:TImage;
      function YToTop(Y:integer):integer;
      function XToLeft(X:integer):integer;
    public
      constructor Create(CodPeca:integer);
      destructor Destroy;
      function GetCodigo:integer;
      procedure SetTipo(tipo:TTipoObj);
      function GetTipo:TTipoObj;
      procedure SetImagem(tipo:TTipoObj;Owner:TWinControl;caminho:string);
      procedure SetPosicao(X,Y:integer);
      function GetPosX:integer;
      function GetPosY:integer;
      procedure SetClick(evento:TNotifyEvent);
  end;

  TTabuleiro = class(TObject)
    private
      mTabuleiro:array [1..7,1..7] of integer; // codigoPeca = ocupado; 0 = vazio;
    public
      constructor Create();
      procedure SetOcupado(posX,posY, ocupado:integer);
      function GetPosXY(posX,posY:integer):integer;
  end;



implementation

{ TPeca }

constructor TPeca.Create(codPeca:integer);
begin
  pCodigo := CodPeca;
end;

destructor TPeca.Destroy;
begin
//  FreeAndNil(pImagem);
  pImagem.Visible := False;
//  pImagem.Destroy;
end;

function TPeca.GetTipo:TTipoObj;
begin
  result := pTipo
end;

procedure TPeca.SetImagem(tipo: TTipoObj;Owner:TWinControl;caminho:string);
begin
  pImagem := TImage.Create(nil);
  pImagem.Parent := Owner;
  pImagem.Tag := pCodigo;
  pImagem.Visible := True;
  pImagem.AutoSize := True;
  pImagem.Picture.LoadFromFile(caminho);
  pImagem.BringToFront;

  case tipo of
    toRaposa   :pTop := 5;//pq o tamanhho da imagem da raposa não é o mesmo do quadro como com o ganso
    toGanso    :pTop := 0;
    else
    begin
      pImagem.AutoSize := False;
      pTop := -2;
      pLeft := -2;
      pImagem.Width := 54;
      pImagem.Height := 50;
      pImagem.Stretch := True;
    end;
  end;
end;

procedure TPeca.SetTipo(tipo: TTipoObj);
begin
  pTipo := tipo;
end;

function TPeca.YToTop(Y: integer):integer;
//  328 = valor mais baixo de y no tabuleiro; y = 0
begin
  result := pTop + 328 - (QtdTopMov * (Y-1));
end;

function TPeca.XToLeft(X: integer): integer;
//  9 = valor mais baixo de x no tabuleiro; x = 0
begin
  result := pLeft + 9 + (QtdLeftMov * (X-1));
end;

procedure TPeca.SetPosicao(X, Y: integer);
begin
  if ((X > 0) and (Y > 0)
  and (X < 8) and (Y < 8)) then
  begin
    pImagem.Left := XToLeft(X);
    pImagem.Top := YToTop(Y);
    pX := X;
    pY := Y;
  end;
end;

function TPeca.GetPosX: integer;
begin
  result := pX;
end;

function TPeca.GetPosY: integer;
begin
  result := pY;
end;

procedure TPeca.SetClick(evento: TNotifyEvent);
begin
  pImagem.OnClick := evento;
end;

function TPeca.GetCodigo: integer;
begin
  result := pCodigo;
end;

{ TTabuleiro }

constructor TTabuleiro.Create();
var i,j:integer;
begin
  for i := 1 to 7 do
  begin
    for j := 1 to 7 do
    begin
      case i of
        1,2,6,7:
        begin
          case j of
            1,2,6,7:mTabuleiro[i,j] := 99; //conta como "ocupado"
            else mTabuleiro[i,j] := 0;        //esvazia o tabuleiro
          end;
        end else mTabuleiro[i,j] := 0;
      end;
    end;
  end;
end;

function TTabuleiro.GetPosXY(posX, posY: integer): integer;
begin
  if ((posX > 0) and (posY > 0)
  and (posX < 8) and (posY < 8)) then
    result := mTabuleiro[posX,posY]; 
end;

procedure TTabuleiro.SetOcupado(posX, posY, ocupado: integer);
begin
  if ((posX > 0) and (posY > 0)
  and (posX < 8) and (posY < 8)) then
    mTabuleiro[posX,posY] := ocupado;
end;

end.
