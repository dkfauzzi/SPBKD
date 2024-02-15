<?

<select class="form-select" aria-label="Default select example" name="level">
    @foreach($allLevels as $levelValue)
        <option value="{{ $levelValue }}" {{ $data->level == $levelValue ? 'selected' : '' }}>
            @switch($levelValue)
                @case('dekan')
                    Dekan
                    @break
                @case('wakildekan1')
                    Wakil Dekan 1
                    @break
                @case('wakildekan2')
                    Wakil Dekan 2
                    @break
                @case('dosen')
                    Dosen
                    @break
                @case('sekretariat2')
                    Sekretariat
                    @break
                @case('kaprodi')
                    Ketua Program Studi
                    @break
                @case('ketuaKK')
                    Ketua Kelompok Keahlian
                    @break
                @default
                    {{ $levelValue }}
            @endswitch
        </option>
    @endforeach
</select>
