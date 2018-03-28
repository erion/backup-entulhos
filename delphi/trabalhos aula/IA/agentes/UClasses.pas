unit UClasses;

interface

uses SysUtils, Dialogs;

const
  TabLinhas  :integer = 22;
  TabColunas :integer = 22;

type

  TTipoObj = (toAgenteP, toAgenteV, toCasaP, toCasaV);

  TTabuleiro = class(TObject)
    private
      tTab:array [1..22,1..22] of integer; // codigoPeca = ocupado; 0 = vazio;
    public
      constructor Create();
      procedure SetOcupado(posX,posY, ocupado:integer);// ocupado = codAgente; 0 = vazio; 99 = casa
      function GetPosXY(posX,posY:integer):integer;
  end;


  TAgente = class(TObject)
    private
      aCodigo,
      aX,
      aY,
      aOldX,
      aOldY :integer;
      aTipo : TTipoObj;
      aEncontrouCasa :boolean;
    public
      constructor Create;
      procedure SetCodigo(cod:integer);
      function GetCodigo:integer;
      procedure SetPosicao(x,y:integer);
      function GetPosX:integer;
      function GetPosY:integer;
      procedure SetTipo(tipo:TTipoObj);
      function GetTipo:TTipoObj;
      procedure SetCasaEncontrada;
      function GetCasaEncontrada:boolean;
      function VerificaLados(tabuleiro:TTabuleiro):boolean;
  end;


implementation



{ TTabuleiro }

constructor TTabuleiro.Create();
var i,j:integer;
begin
  for i := 1 to TabColunas do
  begin
    for j := 1 to TabLinhas do
    begin
      tTab[i,j] := 0;
    end;
  end;
end;

function TTabuleiro.GetPosXY(posX, posY: integer): integer;
begin
  if ((posX < 22) and (posY < 22)
  and (posX > 0)  and (posY > 0)) then
    Result := tTab[posX,posY]
  else
    Result := 1;
end;

procedure TTabuleiro.SetOcupado(posX, posY, ocupado: integer);
begin
  if ((posX < 22) and (posY < 22)
  and (posX > 0)  and (posY > 0)) then
    tTab[posX,posY] := ocupado;
end;

{ TAgente }

constructor TAgente.Create;
begin
  aCodigo := 0;
  aX := 0;
  aY := 0;
  aOldX := 0;
  aOldY := 0;
  aEncontrouCasa := False;
end;

function TAgente.GetCasaEncontrada: boolean;
begin
  result := aEncontrouCasa;
end;

function TAgente.GetCodigo: integer;
begin
  Result := aCodigo; 
end;

function TAgente.GetPosX: integer;
begin
  Result := aX;
end;

function TAgente.GetPosY: integer;
begin
  Result := aY;
end;

function TAgente.GetTipo: TTipoObj;
begin
  Result := aTipo;
end;

procedure TAgente.SetCasaEncontrada;
begin
  aEncontrouCasa := True;
  MessageDlg('Agente nº ' + IntToStr(aCodigo) + ' encontrou sua casa',mtInformation,[mbOK],0);
end;

procedure TAgente.SetCodigo(cod: integer);
begin
  aCodigo := cod;
end;

procedure TAgente.SetPosicao(x, y: integer);
begin
  if ((x < 22) and (y < 22)
  and (x >= 0)  and (y >= 0)) then
  begin
    aOldX := aX;
    aOldY := aY;
    aX := x;
    aY := y;
  end;  
end;

procedure TAgente.SetTipo(tipo: TTipoObj);
begin
  aTipo := tipo;
end;

function TAgente.VerificaLados(tabuleiro:TTabuleiro): boolean;
var  // um agente encherga apenas ao seu redor.
  aux: integer;
begin
  Result := False;
  if not aEncontrouCasa then
  begin
    if (((tabuleiro.GetPosXY(aX-1,aY) = 99) and (aTipo = toAgenteP))
    or  ((tabuleiro.GetPosXY(aX-1,aY) = 98) and (aTipo = toAgenteV))) then
    begin
      SetPosicao(aX-1,aY);
      tabuleiro.SetOcupado(aOldX,aOldY,0);
      Result := True;
      SetCasaEncontrada;
    end else
    if (((tabuleiro.GetPosXY(aX+1,aY) = 99) and (aTipo = toAgenteP))
    or  ((tabuleiro.GetPosXY(aX+1,aY) = 98) and (aTipo = toAgenteV))) then
    begin
      SetPosicao(aX+1,aY);
      tabuleiro.SetOcupado(aOldX,aOldY,0);
      Result := True;
      SetCasaEncontrada;
    end else
    if (((tabuleiro.GetPosXY(aX,aY+1) = 99) and (aTipo = toAgenteP))
    or  ((tabuleiro.GetPosXY(aX,aY+1) = 98) and (aTipo = toAgenteV))) then
    begin
      SetPosicao(aX,aY+1);
      tabuleiro.SetOcupado(aOldX,aOldY,0);
      Result := True;
      SetCasaEncontrada;
    end else
    if (((tabuleiro.GetPosXY(aX,aY-1) = 99) and (aTipo = toAgenteP))
    or  ((tabuleiro.GetPosXY(aX,aY-1) = 98) and (aTipo = toAgenteV))) then
    begin
      SetPosicao(aX,aY-1);
      tabuleiro.SetOcupado(aOldX,aOldY,0);
      Result := True;
      SetCasaEncontrada;
    end else
    begin
      aux := Random(4);
      case aux of
        0:
        begin
          if ((tabuleiro.GetPosXY(aX-1,aY) = 0) and (aX-1 <> aOldX)) then
          begin
            tabuleiro.SetOcupado(aX-1,aY,aCodigo);
            SetPosicao(aX-1,aY);
            tabuleiro.SetOcupado(aOldX,aOldY,0);
          end;
        end;
        1:
        begin
          if ((tabuleiro.GetPosXY(aX+1,aY) = 0) and (aX+1 <> aOldX)) then
          begin
            tabuleiro.SetOcupado(aX+1,aY,aCodigo);
            SetPosicao(aX+1,aY);
            tabuleiro.SetOcupado(aOldX,aOldY,0);
          end;
        end;
        2:
        begin
          if ((tabuleiro.GetPosXY(aX,aY+1) = 0) and (aY+1 <> aOldY)) then
          begin
            tabuleiro.SetOcupado(aX,aY+1,aCodigo);
            SetPosicao(aX,aY+1);
            tabuleiro.SetOcupado(aOldX,aOldY,0);
          end;
        end;
        3:
        begin
          if ((tabuleiro.GetPosXY(aX,aY-1) = 0) and (aY-1 <> aOldY)) then
          begin
            tabuleiro.SetOcupado(aX,aY-1,aCodigo);
            SetPosicao(aX,aY-1);
            tabuleiro.SetOcupado(aOldX,aOldY,0);
          end;
        end;
      end;
    end;
  end;
end;

end.
